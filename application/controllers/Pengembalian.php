<?php

class Pengembalian extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('ion_auth');
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login', 'refresh');
    }
  }

  function index()
  {
    $i = 0;
    $this->load->model('Model_pengembalian');
    $this->load->model('Model_buku');
    $this->load->library('tanggal');
    $user_id = $this->session->userdata['user_id'];
    if(!$this->ion_auth->is_admin()){
      $data['pengembalian'] = $this->Model_pengembalian->list_pengembalian_by_user($user_id);
    }else{
      $data['pengembalian'] = $this->Model_pengembalian->list_pengembalian();
    }

    $jumlah_data	        = $data['pengembalian']->num_rows();
    $data_pengembalian		= $data['pengembalian']->result();;

    while($i < $jumlah_data){
      $this->db->select('judul_buku');
      $this->db->where('id_buku',$data_pengembalian[$i]->id_buku);
      $data_pengembalian[$i]->judul_buku	= $this->Model_buku->list_buku()->result()[0]->judul_buku;
      $i++;
    }
    $data['pengembalian'] = $data_pengembalian;
    $this->load->view('list_pengembalian',  $data);
  }

  function form_pengembalian(){
    if (!$this->ion_auth->is_admin())
    {
      return show_error('Anda tidak dibolehkan mengakses halaman ini.');
    }
    else
    {
      $this->load->model('model_peminjaman');
      $this->db->order_by('kode_buku', 'ASC');
      $data['pinjam'] = $this->model_peminjaman->list_peminjaman()->result();
      $this->load->view('form_pengembalian',  $data);
    }
  }

  function lihat_detail(){
    date_default_timezone_set('Asia/Jakarta');
    $this->load->library('tanggal');

    $kode_buku = $this->input->post('kode_buku');
    $this->load->model('model_peminjaman');
    $this->load->model('model_buku');
    $this->load->model('model_anggota');
    $this->load->model('model_setting');

    $this->db->where('kode_buku' ,$kode_buku);
    $data['pinjam'] = $this->model_peminjaman->detail_peminjaman()->row_array();

    $this->db->like('kode_buku' , $data['pinjam']['kode_buku'],'after');
    $this->db->select('id_buku');
    $id_buku =  $this->db->get('bukus')->result()[0]->id_buku;

    $this->db->where('id_buku' , $id_buku);
    $this->db->select('judul_buku');
    $judul_buku = $this->model_buku->list_buku()->result()[0]->judul_buku;

    $this->db->where('id', $data['pinjam']['id_anggota']);
    $this->db->select('nama_anggota');
    $nama_anggota = $this->model_anggota->list_anggota()->result()[0]->nama_anggota;

    $data['pinjam']['id_buku'] = $id_buku;
    $data['pinjam']['judul_buku'] = $judul_buku;
    $data['pinjam']['nama_anggota'] = $nama_anggota;

    $this->db->select('nilai_setting')->where('id_setting','1');
    $denda = $this->model_setting->list_setting()->row_array()['nilai_setting'];

    $this->db->select('nilai_setting')->where('id_setting','2');
    $lama_boleh_pinjam = $this->model_setting->list_setting()->row_array()['nilai_setting'];
    // die(print_r($data['pinjam']));
    $tanggal_pinjam = new DateTime($data['pinjam']['tanggal_pinjam']);
    $hari_ini = new DateTime();
    $lama_pinjam = $tanggal_pinjam->diff($hari_ini)->days;
    $lama_keterlambatan = $lama_pinjam-$lama_boleh_pinjam;
    if($lama_keterlambatan < 0){
      $lama_keterlambatan = 0;
    }
    if($lama_pinjam > $lama_boleh_pinjam){
      $data['pinjam']['denda'] = $denda * $lama_keterlambatan;
    }else{
      $data['pinjam']['denda'] = 0;
    }

    $data['pinjam']['lama_keterlambatan'] = $lama_keterlambatan;
    $data['pinjam']['lama_pinjam'] = $lama_pinjam;

    $this->load->view('detail_peminjaman' , $data);
  }

  function simpan_pengembalian(){
    $this->load->model('Model_pengembalian');
    $this->load->model('Model_peminjaman');
    $this->load->model('Model_buku');
    $kode_buku = $this->input->post('kode_buku');
    $data = array(
              'id_anggota'        => $this->input->post('id_anggota'),
              'kode_bukus'        => $kode_buku,
              'id_buku'           => $this->input->post('id_buku'),
              'tanggal_pinjam'    => $this->input->post('tanggal_pinjam'),
              'tanggal_kembali'   => $this->input->post('tanggal_kembali'),
              'lama_peminjaman'   => $this->input->post('lama_peminjaman'),
              'lama_keterlambatan' => $this->input->post('lama_keterlambatan'),
              'denda'             => $this->input->post('denda')

            );
    $res = $this->Model_pengembalian->simpan_pengembalian($data);
    if($res == 0){
      $this->session->set_flashdata('pesan' , 'Gagal Proses Pengembalian');
      redirect('Pengembalian/form_pengembalian');
    }else{
      $ress = $this->Model_peminjaman->hapus_peminjaman($kode_buku);
      if($ress == 0){
        $this->session->set_flashdata('pesan' , 'Gagal Proses Hapus Peminjaman');
        redirect('Pengembalian/form_pengembalian');
      }else{
        $resss = $this->Model_buku->ubah_status($kode_buku);
        if($resss == 0){
          $this->session->set_flashdata('pesan' , 'Gagal Ubah Status Buku');
          redirect('Pengembalian/form_pengembalian');
        }else{
          $this->session->set_flashdata('pesan' , 'Proses POS Berhasil');
          redirect('Pengembalian/form_pengembalian');
        }
      }
    }
  }

}

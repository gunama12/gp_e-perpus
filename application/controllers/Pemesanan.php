<?php


class Pemesanan extends CI_Controller
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

  function index(){
    $i = 0;
    $this->load->model('Model_pemesanan');
    $this->load->model('Model_buku');
    $this->load->library('tanggal');
    $user_id = $this->session->userdata['user_id'];
    if(!$this->ion_auth->is_admin()){
      $data['list'] = $this->Model_pemesanan->list_pemesanan_by_user($user_id);
    }else{
      $data['list'] = $this->Model_pemesanan->list_pemesanan();
    }

    $jumlah_data          = $data['list']->num_rows();
    $data_pemesanan    = $data['list']->result();;

    while($i < $jumlah_data){
      $this->db->select('judul_buku');
      $this->db->where('id_buku',$data_pemesanan[$i]->id_buku);
      $data_pemesanan[$i]->judul_buku  = $this->Model_buku->list_buku()->result()[0]->judul_buku;
      $i++;
    }
    $data['list'] = $data_pemesanan;
    $this->load->view('list_pemesanan', $data);
    
  }

  function pre_pemesanan(){
    /*
    $id_anggota = 18;
    $this->load->model('Model_pemesanan');
    $cek =
    */

    if($this->ion_auth->is_admin()) 
    {
      return show_error('Hanya member yang dapat memesan buku.');
    }
    else{
      $id_buku = $this->uri->segment(3);
      $this->load->model('Model_buku');
      $this->db->select('judul_buku');
      $this->db->where('id_buku' ,  $id_buku);
      $data['judul_buku'] = $this->Model_buku->list_buku()->result()[0]->judul_buku;
      $data['id_buku'] = $id_buku;
      $data['id_anggota'] = $this->session->userdata('user_id');
      $this->load->view('pre_pemesanan' ,$data);
    }
  }

  function simpan_pemesanan(){
    $data = array(
      'id_anggota' => $this->input->post('id_anggota'),
      'id_buku'    => $this->input->post('id_buku'),
      'tanggal_pesan' => date('Y-m-d')
    );
    $this->load->model('Model_pemesanan');
    $res = $this->Model_pemesanan->insert_pemesanan($data);

    if($res == 0){
      $this->session->set_flashdata('pesan', 'Gagal Pesan');
      redirect('buku');
    }else{
      $this->session->set_flashdata('pesan', 'Berhasil Pesan, Silahkan Datang Hari ini ke Perpustakaan Mengambil Buku');
      redirect('buku');
    }

  }

  function arsipkan(){
    $id_pemesanan = $this->uri->segment(3);
    $this->load->model('Model_pemesanan');
    $resss = $this->Model_pemesanan->arsip($id_pemesanan);
      if($resss == 0){
        $this->session->set_flashdata('pesan' , 'Gagal arsipkan pemesanan');
        redirect('Pemesanan');
      }else{
        $this->session->set_flashdata('pesan' , 'Proses arsip berhasil');
        redirect('Pemesanan');
      }
  }

}

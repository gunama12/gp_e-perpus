<?php

class Peminjaman extends CI_Controller
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
    $this->load->model('model_peminjaman');
    $user_id = $this->session->userdata['user_id'];
    if(!$this->ion_auth->is_admin()){
      $data['list'] = $this->model_peminjaman->list_peminjaman_by_user($user_id)->result();
    }else{
      $data['list'] = $this->model_peminjaman->list_peminjaman()->result();
    }
    $this->load->library('tanggal');

    //$tanggal = str_replace('-','', $data['list'][8]->tanggal_pinjam);

    $this->load->view('list_peminjaman', $data);

  }

  function pinjam_buku(){
    if (!$this->ion_auth->is_admin())
    {
      return show_error('Anda tidak dibolehkan mengakses halaman ini.');
    }
    else 
    {
      $this->load->view('form_pinjam' );
    }
  }

  function simpan_pinjam_buku(){
    date_default_timezone_set('Asia/Jakarta');
    $tanggal_pinjam = date('Y-m-d');

    $id_anggota = $this->input->post('id_anggota');
    $kode_buku  = $this->input->post('kode_buku');
    $data = array(
              'id_anggota' => $id_anggota,
              'kode_buku'  => $kode_buku,
              'tanggal_pinjam' => $tanggal_pinjam
            );
    $this->load->model('model_peminjaman');
    $result = $this->model_peminjaman->tambah_peminjaman($data);
    if($result = 0){
      $this->session->set_flashdata('pesan', 'Gagal Proses');
      redirect('Peminjaman');
    }else{
      $this->session->set_flashdata('pesan', 'Transaksi Berhasil');
      redirect('Peminjaman');
    }
  }
}

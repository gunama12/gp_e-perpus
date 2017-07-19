<?php

class Kategori extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('ion_auth');
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login', 'refresh');
    }
    elseif (!$this->ion_auth->is_admin()) 
    {
      return show_error('Anda tidak dibolehkan mengakses halaman ini.');
    }
  }
  
  function index()
  {
    $this->load->model('Model_kategori');
    $data['list_kategori'] = $this->Model_kategori->list_kategori()->result();
    $this->load->view('list_kategori', $data);
  }

  function tambah(){
    $this->load->view('tambah_kategori');
  }

  function tambah_simpan(){
    $data_kategori = array(
                    'nama_kategori' => $this->input->post('nama_kategori')
                  );
    $data_kategori = $this->security->xss_clean($data_kategori);
    $data_kategori = $this->db->escape_str($data_kategori);
    $this->load->model('Model_kategori');
    $result = $this->Model_kategori->tambah_kategori($data_kategori);
    if($result > 0){
      $this->session->set_flashdata('pesan', 'Berhasil Tambah');
      redirect('Kategori');
    }else{
      $this->session->set_flashdata('pesan', 'Operasi Gagal');
      redirect('Kategori');
    }
  }

  function ubah(){
    $id_kategori = $this->uri->segment(3);
    $this->load->model('Model_kategori');
    $data['kategori']	= $this->Model_kategori->detail_kategori($id_kategori)->row_array();
    $this->load->view('edit_kategori', $data);

  }

  function edit_simpan(){
    $id_kategori =$this->input->post('id');
    $data_kategori 	= array(
        'nama_kategori' => $this->input->post('nama_kategori')
        );
    $data_kategori = $this->security->xss_clean($data_kategori);
    $data_kategori = $this->db->escape_str($data_kategori);
    $this->load->model('model_kategori');
    $result = $this->model_kategori->update_kategori($id_kategori,$data_kategori);
    if($result > 0){
      $this->session->set_flashdata('pesan', 'Berhasil Edit');
      redirect('kategori');
    }else{
      $this->session->set_flashdata('pesan', 'Operasi Gagal');
      redirect('kategori');
    }

  }

  function hapus(){
    $id_kategori = $this->uri->segment(3);
    $this->db->where('id_kategori', $id_kategori);
    $query = $this->db->delete('kategori');
    if($query > 0){
      $this->session->set_flashdata('pesan', 'Berhasil Hapus');
      redirect('kategori');
    }else{
      $this->session->set_flashdata('pesan', 'Operasi Gagal');
      redirect('kategori');
    }
  }
}

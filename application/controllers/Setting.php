<?php

class Setting extends CI_Controller
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
  
  function index(){
    $this->load->model('Model_setting');
    $data['setting'] = $this->Model_setting->list_setting()->result();
    $this->load->view('Setting' ,$data);
  }

  function update_setting(){
    $this->load->model('Model_setting');
    $input = $this->input->post();

    $i = 1;
    foreach ($input as $nilai) {
      if($nilai == 'Simpan'){
        break;
      }
      $this->db->where('id_setting' , $i);
      $res = $this->Model_setting->simpan_setting($nilai);
      if($res == 0){
        $this->session->set_flashdata('pesan', 'gagal simpan setting');
        redirect('Setting');
      }
      $i++;
    }
    $this->session->set_flashdata('pesan', 'Berhasil simpan setting');
    redirect('Setting');

  }

}

 ?>

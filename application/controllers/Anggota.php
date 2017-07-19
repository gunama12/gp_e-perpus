<?php

class Anggota extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('ion_auth');
    if (!$this->ion_auth->logged_in())
    {
      // redirect them to the login page
      redirect('auth/login', 'refresh');
    }
    elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
    {
      // redirect them to the home page because they must be an administrator to view this
      return show_error('Anda tidak dibolehkan mengakses halaman ini.');
    }
  }

  function index(){
    
      $this->load->model('model_anggota');
      $data['anggota'] = $this->model_anggota->list_anggota()->result();
      $this->load->view('list_anggota'  , $data);
    
  }

  function tambah_anggota(){
    $this->load->view('tambah_anggota');

  }

  function simpan_anggota(){
    $this->load->model('model_anggota');
    $nama   = $this->input->post('nama');
    $jk   = $this->input->post('jk');
    $tanggal   = $this->input->post('tanggal');
    $alamat   = $this->input->post('alamat');

    $config['upload_path'] = './foto_anggota/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']     = '10000';
    $config['file_name']		= $this->input->post('nama');
    $config['max_width'] = '1368';
    $config['max_height'] = '900';
    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('userfile'))
    {
      $this->session->set_flashdata('pesan','Ada masalah dengan file anda');
      $this->load->view('tambah_anggota');
  }else{

    		$data 	= array(
    				'nama_anggota' => $nama,
    				'jk' => $jk,
    				'tanggal_lahir' => $tanggal,
    				'alamat' => $alamat,
    				'foto_anggota'   => $this->upload->data('file_name')
    			);

    		$data = $this->security->xss_clean($data);
    		$data = $this->db->escape_str($data);

    		$result = $this->model_anggota->tambah_anggota($data);

        if($result > 0){
          $this->session->set_flashdata('pesan', 'Berhasil Tambah');
          redirect('Anggota');
        }else{
          $this->session->set_flashdata('pesan', 'Operasi Gagal');
          redirect('Anggota');
        }
      }

    }

    function hapus_anggota(){
      $this->load->helper('file');
      $id_anggota = $this->uri->segment(3);
      $foto_anggota = $this->uri->segment(4);

      $this->db->where('id_anggota', $id_anggota);
      $result = $this->db->delete('anggota');
      if($result == 1){
        unlink('./foto_anggota/'.$foto_anggota);

        $this->session->set_flashdata('pesan', 'Berhasil Hapus');
        redirect('Anggota');

      }else{
        $this->session->set_flashdata('pesan', 'Gagal Operasi');
        redirect('Anggota');
      }
    }

    function edit_anggota(){
      $id_anggota = $this->uri->segment(3);
      $this->load->model('Model_anggota');
      $data   = $this->Model_anggota->detail_anggota($id_anggota)->row_array();
      $this->load->view('edit_anggota' , $data);
    }

    function simpan_edit_anggota(){
      $this->load->model('model_anggota');
      $id_anggota   = $this->input->post('id_anggota');
      $nama        = $this->input->post('nama');
      $jk   = $this->input->post('jk');
      $tanggal   = $this->input->post('tanggal');
      $alamat   = $this->input->post('alamat');

          $data 	= array(
      				'nama_anggota' => $nama,
      				'jk' => $jk,
      				'tanggal_lahir' => $tanggal,
      				'alamat' => $alamat,
      			);

      		$data = $this->security->xss_clean($data);
      		$data = $this->db->escape_str($data);

      		$result = $this->model_anggota->update_anggota($data,$id_anggota);

          if($result > 0){
            $this->session->set_flashdata('pesan', 'Berhasil Update');
            redirect('anggota');
          }else{
            $this->session->set_flashdata('pesan', 'Operasi Gagal');
            redirect('anggota');
          }
        }

}

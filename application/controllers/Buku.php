<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {


	var $i;

	public function __construct(){
		parent::__construct();
		$this->load->library('ion_auth');
	}
	public function index()
	{
		$this->load->model('model_buku');
		$data['list_buku']	= $this->model_buku->list_buku();
		$jumlah_data	= $data['list_buku']->num_rows();
		$data_buku		= $data['list_buku']->result();;

		$i=0;
		while($i < $jumlah_data){
			$data_buku[$i]->stok 				= $this->model_buku->cek_stok($data_buku[$i]->id_buku)->num_rows();
			$data_buku[$i]->jumlah_stok = $this->model_buku->cek_jumlah_stok($data_buku[$i]->id_buku)->num_rows();

			$i++;
		}
		$data['list_buku'] = $data_buku;
		$this->load->view('list_buku', $data);
	}

	function tambah_buku(){
		if (!$this->ion_auth->logged_in())
	    {
	      redirect('auth/login', 'refresh');
	    }
	    elseif (!$this->ion_auth->is_admin()) 
	    {
	      return show_error('Anda tidak dibolehkan mengakses halaman ini.');
	    }
	    else
	    {
			$this->load->model('Model_kategori');
			$this->db->select('nama_kategori');
			$data['kategori'] = $this->Model_kategori->list_kategori()->result();


			$this->load->view('tambah_buku', $data);
		}
	}

	function tambah_simpan(){
		$this->load->model('Model_kategori');
		$this->load->model('model_buku');
		$cek = $this->model_buku->cek_judul_buku($this->input->post('judul_buku'));
		$cek2 = $this->model_buku->cek_kode_buku($this->input->post('kode'));
		if($cek > 0){

			$this->db->select('nama_kategori');
			$data['kategori'] = $this->Model_kategori->list_kategori()->result();

			$this->session->set_flashdata('pesan','Judul Buku Sudah Ada');
			$this->load->view('tambah_buku', $data);
		}else	if($cek2 > 0){

			$this->db->select('nama_kategori');
			$data['kategori'] = $this->Model_kategori->list_kategori()->result();

			$this->session->set_flashdata('pesan','Kode Buku Sudah Ada');
			$this->load->view('tambah_buku', $data);
		}else{
		$config['upload_path'] = './foto_buku/';

		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']     = '10000';
		$config['file_name']		= $this->input->post('judul_buku');
		$config['max_width'] = '1920';
		$config['max_height'] = '2560';
		$this->load->library('upload', $config);

	  if ( ! $this->upload->do_upload('userfile'))
		{

			$this->db->select('nama_kategori');
			$data['kategori'] = $this->Model_kategori->list_kategori()->result();

			$this->session->set_flashdata('pesan','Ada masalah dengan file anda');
			$this->load->view('tambah_buku', $data);
		}else{
			$config['source_image'] = './foto_buku/'.$this->upload->data('file_name');
			$config['wm_text'] = 'Copyright 2016 E-PERPUS';
			$config['wm_type'] = 'text';
			$config['wm_font_path'] = './system/fonts/texb.ttf';
			$config['wm_font_size'] = '100';
			$config['wm_font_color'] = 'ffffff';
			$config['wm_vrt_alignment'] = 'middle';
			$config['wm_hor_alignment'] = 'center';
			$config['wm_padding'] = '20';

			$this->load->library('image_lib', $config);
			$this->image_lib->watermark();

		$data_buku 	= array(
				'judul_buku' => $this->input->post('judul_buku'),
				'pengarang' => $this->input->post('pengarang'),
				'penerbit' => $this->input->post('penerbit'),
				'tahun' => $this->input->post('tahun'),
				'kategori' => $this->input->post('kategori'),
				'foto_buku'   => $this->upload->data('file_name')
			);

		$data_buku = $this->security->xss_clean($data_buku);
		$data_buku = $this->db->escape_str($data_buku);

		$result = $this->model_buku->tambah_buku($data_buku);

		$bukus 	= array(
				'jumlah_stok' => $this->input->post('jumlah_stok'),
				'kode_buku' => $this->input->post('kode')
			);

		$this->db->select_max('id_buku');
		$id_buku =  $this->model_buku->list_buku()->row_array();
		$bukus = $this->security->xss_clean($bukus);
		$bukus = $this->db->escape_str($bukus);
		$result = $this->model_buku->tambah_stok($bukus,$id_buku['id_buku']);

		if($result > 0){
			$this->session->set_flashdata('pesan', 'Berhasil Tambah');
			redirect('Buku');
		}else{
			$this->session->set_flashdata('pesan', 'Operasi Gagal');
			redirect('Buku');
		}
	}
}
}

	function edit_buku(){
		if (!$this->ion_auth->logged_in())
	    {
	      redirect('auth/login', 'refresh');
	    }
	    elseif (!$this->ion_auth->is_admin()) 
	    {
	      return show_error('Anda tidak dibolehkan mengakses halaman ini.');
	    }
	    else{
			$this->load->model('Model_kategori');
			$this->db->select('nama_kategori');
			$data['kategori'] = $this->Model_kategori->list_kategori()->result();

			$id_buku = $this->uri->segment(3);
			$this->load->model('model_buku');
			$data['buku']	= $this->model_buku->detail_buku($id_buku)->row_array();
			$this->load->view('edit_buku', $data);
		}
	}

	function detail_buku(){
		$id_buku = $this->uri->segment(3);
		$this->load->model('model_buku');
		$data['buku']	= $this->model_buku->detail_buku($id_buku)->row_array();
		$data['bukus']	= $this->model_buku->cek_jumlah_stok($id_buku)->result();
		$data['buku']['jumlah_stok'] =  $this->model_buku->cek_jumlah_stok($id_buku)->num_rows();

		$this->load->view('detail_buku', $data);

	}

	function edit_simpan(){
		$id_buku =$this->input->post('id');
		$data_buku 	= array(
				'judul_buku' => $this->input->post('judul_buku'),
				'pengarang' => $this->input->post('pengarang'),
				'penerbit' => $this->input->post('penerbit'),
				'tahun' => $this->input->post('tahun'),
				'kategori' => $this->input->post('kategori')
				);
		$data_buku = $this->security->xss_clean($data_buku);
		$data_buku = $this->db->escape_str($data_buku);
		$this->load->model('model_buku');
		$result = $this->model_buku->update_buku($id_buku,$data_buku);
		if($result > 0){
			$this->session->set_flashdata('pesan', 'Berhasil Edit');
			redirect('Buku');
		}else{
			$this->session->set_flashdata('pesan', 'Operasi Gagal');
			redirect('Buku');
		}

	}

	function hapus_buku(){

		$id_buku = $this->uri->segment(3);
		$this->db->where('id_buku', $id_buku)->delete(array('buku','bukus'));
		$this->session->set_flashdata('pesan', 'Selesai Hapus');
		redirect('Buku');
	}

	function hapus_bukus(){

		$id_bukus = $this->uri->segment(3);
		$id_buku = $this->uri->segment(4);
		$this->db->where('id_bukus', $id_bukus)->delete('bukus');
		$this->session->set_flashdata('pesan', 'Selesai Hapus Stok');
		redirect('Buku/detail_buku/'.$id_buku);
	}

	function update_stok(){
		if (!$this->ion_auth->logged_in())
	    {
	      redirect('auth/login', 'refresh');
	    }
	    elseif (!$this->ion_auth->is_admin()) 
	    {
	      return show_error('Anda tidak dibolehkan mengakses halaman ini.');
	    }
	    else{
			$id_buku = $this->uri->segment(3);
			$this->load->model('model_buku');
			$data ['buku']= $this->db->query("select bukus.id_bukus, bukus.kode_buku, bukus.status, buku.judul_buku from bukus, buku where
	 														 bukus.id_bukus=(SELECT MAX(bukus.id_bukus) from bukus where bukus.id_buku=$id_buku) and buku.id_buku = $id_buku")->row_array();

			$kode_buku = substr($data['buku']['kode_buku'],0,3);
			$angka_kode_terakhir = substr($data['buku']['kode_buku'],3,3);
			if(	$data ['buku']['status'] == 2){
					$angka_kode_baru     = $angka_kode_terakhir;
			}else{
			$angka_kode_baru     = $angka_kode_terakhir+1;
		  }
			$kode_baru = $kode_buku.$angka_kode_baru;
			$data['buku']['id_buku'] = $id_buku;
		  	$data['buku']['kode_baru'] = $kode_baru;
			$data ['stok']= $this->model_buku->cek_jumlah_stok($id_buku)->num_rows();
		    $this->load->view('update_stok', $data);
		}
	}

	function simpan_update_stok(){
		$id_buku = $this->input->post('id_buku');
		$awal_kode_buku = substr($this->input->post('kode_baru'),0,3);
		$angka_kode_baru = substr($this->input->post('kode_baru'),3,3);

		$this->load->model('model_buku');
		$this->db->where('status', '2');
		$this->db->where('id_buku', $id_buku);
		$this->db->delete('bukus');

		$bukus = array(

								'jumlah_stok' 		=> $this->input->post('stok'),
								'kode_buku'    				=> $awal_kode_buku,
								'angka'						=> $angka_kode_baru
							);

		$bukus = $this->security->xss_clean($bukus);
		$bukus = $this->db->escape_str($bukus);
		$result = $this->model_buku->tambah_stok($bukus,$id_buku);

		if($result > 0){
			$this->session->set_flashdata('pesan', 'Berhasil Tambah Stok');
			redirect('Buku');
		}else{
			$this->session->set_flashdata('pesan', 'Operasi Gagal');
			redirect('Buku');
		}
	}
}

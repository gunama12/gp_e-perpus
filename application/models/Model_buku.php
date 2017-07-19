<?php

class Model_buku extends CI_Model{

	function Model_buku(){
		parent::__construct();
	}

	function list_buku(){
		return $this->db->get('buku');

	}

	function tambah_buku($data_buku){
		return $this->db->insert('buku', $data_buku);


	}

	function cek_judul_buku($judul){
		$this->db->where('judul_buku' , $judul);
		return $this->db->get_where('buku')->num_rows();
	}

	function cek_kode_buku($kode_buku){
		$kode_buku = substr($kode_buku,0,3);
		$this->db->like('kode_buku', $kode_buku, 'after');
	  return $this->db->get('bukus')->num_rows();
	}

	function detail_buku($id_buku){
		return $this->db->get_where('buku', array('id_buku' => $id_buku));
	}

	function update_buku($id_buku,$data_buku){

		$this->db->where('id_buku', $id_buku);
		$query = $this->db->update('buku',$data_buku);
		return $query;
	}

	function cek_stok($id_buku){
			return $this->db->get_where('bukus', array('id_buku' => $id_buku, 'status' => 1));

	}

	function cek_jumlah_stok($id_buku){
			return $this->db->get_where('bukus', array('id_buku' => $id_buku, 'status !=' => 2));

	}

	function tambah_stok($bukus,$id_buku){
		if(isset($bukus['angka'])){
			$angka = $bukus['angka'];
		}else{
			$angka = 1;
		}
		$i=1;
		if($bukus['jumlah_stok'] == 0){
				return $this->db->insert('bukus', array('kode_buku'=> $bukus['kode_buku'].'1' , 'id_buku' => $id_buku, 'status' => '2'));
		}else{
			while($i <= $bukus['jumlah_stok']){
				 $result = $this->db->insert('bukus', array('kode_buku'=> $bukus['kode_buku'].$angka , 'id_buku' => $id_buku, 'status' => '1'));
				 $i++;
				 $angka++;
			}
			return $result;
		}
	}

	function ubah_status($kode_buku){
		$this->db->where('kode_buku', $kode_buku);
		return $this->db->update('bukus', array('status' => '1'));
	}
}

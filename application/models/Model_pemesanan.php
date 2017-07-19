<?php

class Model_pemesanan extends CI_Model
{

  function list_pemesanan(){
    return $this->db->get('pemesanan');
  }
  function insert_pemesanan($data){
    return $this->db->insert('pemesanan', $data);
  }
  function list_pemesanan_by_user($id_anggota){
	return $this->db->get_where('pemesanan', array('id_anggota' => $id_anggota));
  }
  function arsip($id_pemesanan){
    	$this->db->where('id_pemesanan', $id_pemesanan);
		return $this->db->update('pemesanan', array('status' => '1'));
  }
}


 ?>

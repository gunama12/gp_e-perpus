<?php

class Model_pengembalian extends CI_Model
{

  function simpan_pengembalian($data){
    return $this->db->insert('pengembalian', $data);
  }

  function list_pengembalian(){
    return $this->db->get('pengembalian');
  }

  function list_pengembalian_by_user($id_anggota){
	return $this->db->get_where('pengembalian', array('id_anggota' => $id_anggota));
  }
}

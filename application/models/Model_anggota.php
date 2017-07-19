<?php

class Model_anggota extends CI_Model
{

  function list_anggota(){
    return $this->db->get('users');
  }

  function detail_anggota($id_anggota){
    return $this->db->get_where('users' , array('id' => $id_anggota));
  }

  function tambah_anggota($data){
    return $this->db->insert('users' , $data);
  }

  function update_anggota($data,$id_anggota){
    $this->db->where('id_anggota', $id_anggota);
    return $this->db->update('users' , $data);
  }
}

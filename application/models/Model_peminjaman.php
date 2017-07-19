<?php

class model_peminjaman extends CI_Model
{

  function tambah_peminjaman($data){
    if(!$this->db->insert('peminjaman' , $data)){
      return '0';
    }else{
      $this->db->where('kode_buku', $data['kode_buku']);
      return $this->db->update('bukus' ,array('status' => '0'));
    }
  }

  function list_peminjaman(){
    return $this->db->get('peminjaman');
  }

  function detail_peminjaman(){
    return $this->db->get('peminjaman');
  }

  function hapus_peminjaman($kode_buku){
    $this->db->where('kode_buku' , $kode_buku);
    return $this->db->delete('peminjaman');
  }

  function list_peminjaman_by_user($id_anggota){
    return $this->db->get_where('peminjaman', array('id_anggota' => $id_anggota));
  }

}

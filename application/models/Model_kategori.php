<?php
class Model_kategori extends CI_Model{

function list_kategori(){
 return $this->db->get('kategori');
}

function tambah_kategori($data_kategori)
{

		return $this->db->insert('kategori', $data_kategori);

}

function detail_kategori($id_kategori){
  return $this->db->get_where('kategori', array('id_kategori' => $id_kategori));
}

function update_kategori($id_kategori,$data_kategori){
  $this->db->where('id_kategori', $id_kategori);
  $query = $this->db->update('kategori',$data_kategori);
  return $query;
}

}

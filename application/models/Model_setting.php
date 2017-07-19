<?php

class Model_setting extends CI_Model
{

function list_setting(){
  return $this->db->get('setting');
}

function simpan_setting($nilai){
  //Update Settingan pada database
  return $this->db->update('setting', array('nilai_setting' => $nilai));
}

}

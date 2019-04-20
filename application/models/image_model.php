<?php
class Image_model extends CI_Model {
     
  public function __construct(){     
    $this->load->database(); 
  }

  public function getimagebyid($id){  
    $this->db->select('id, id_product, file_name, status, dt_create');
    $this->db->from('image');
    $this->db->where('id',$id);
    $this->db->where('status','A');

    $query = $this->db->get();
    if($query->num_rows() == 1){
      return $query->result_array();
    }else{
      return 0;
    }
  }

  public function getallimage(){   
    $this->db->select('id, id_product, file_name, status, dt_create');
    $this->db->from('image');
    $this->db->where('status','A');
    $this->db->order_by('id', 'desc'); 

    $query = $this->db->get();
    if($query->num_rows() > 0){
      return $query->result_array();
    }else{
      return 0;
    }
  }

  public function delete($id){
    $this->db->where('id', $id);
    if($this->db->delete('image')){
      return true;
    }else{
      return false;
    }
  }

  public function add($data){
    if($this->db->insert('image', $data)){
      return true;
    }else{
      return false;
    }
  }

  public function update($id, $data){
    $this->db->where('id', $id);
    if($this->db->update('image', $data)){
      return true;
    }else{
      return false;
    }
  }

}
<?php
class Product_model extends CI_Model {
     
  public function __construct(){     
    $this->load->database(); 
  }

  public function getproductbyid($id){  
    $this->db->select('id, id_user, title, description, status, dt_create, dt_update');
    $this->db->from('product');
    $this->db->where('id',$id);
    $this->db->where('status','A');

    $query = $this->db->get();
    if($query->num_rows() == 1){
      return $query->result_array();
    }else{
      return 0;
    }
  }

  public function getallproduct(){   
    $this->db->select('id, id_user, title, description, status, dt_create, dt_update');
    $this->db->from('product');
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
    if($this->db->delete('product')){
      return true;
    }else{
      return false;
    }
  }

  public function add($data){
    if($this->db->insert('product', $data)){
      return true;
    }else{
      return false;
    }
  }

  public function update($id, $data){
    $this->db->where('id', $id);
    if($this->db->update('product', $data)){
      return true;
    }else{
      return false;
    }
  }

}
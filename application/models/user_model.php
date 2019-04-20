<?php
class User_model extends CI_Model {
     
  public function __construct(){     
    $this->load->database(); 
  }

  public function getuserbyid($id){  
    $this->db->select('id, username, password, email, password, status, dt_create, dt_update');
    $this->db->from('user');
    $this->db->where('id',$id);

    $query = $this->db->get();
    if($query->num_rows() == 1){
      return $query->result_array();
    }else{
      return 0;
    }
  }

  public function getallusers(){   
    $this->db->select('id, username, password, email, password, status, dt_create, dt_update');
    $this->db->from('user');
    $this->db->order_by("id", "desc"); 

    $query = $this->db->get();
    if($query->num_rows() > 0){
      return $query->result_array();
    }else{
      return 0;
    }
  }

  public function delete($id){
    $this->db->where('id', $id);
    if($this->db->delete('tbl_users')){
      return true;
    }else{
      return false;
    }
  }

  public function add($data){
    //var_dump($data);
    if($this->db->insert('user', $data)){
      return true;
    }else{
      return false;
    }
  }

  public function update($id, $data){
    $this->db->where('id', $id);
    if($this->db->update('user', $data)){
      return true;
    }else{
      return false;
    }
  }

}
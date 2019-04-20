<?php
require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
 
class user extends REST_Controller {

	public function __construct() {
       parent::__construct();
       $this->load->model('user_model');
    }

    function userbyid_get()
    {
        $id  = $this->get('id');
        if(!$id){
            $this->response("No user specified", 400);
            exit;
        }
        $result = $this->user_model->getuserbyid($id);
        if($result){
            $this->response($result, 200); 
            exit;
        } 
        else{
         	$this->response("Invalid user", 404);
        	exit;
        }
    }

    function useradd_post()
    {
		$username      	= $this->post('username');
		$email     		= $this->post('email');
		$password    	= $this->post('password');

		if(!$username || !$email || !$password){
		    $this->response("Enter complete user information to save", 400);
		}else{
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$result = $this->user_model->add(
				array(
					"username"	=>$username, 
					"email"		=>$email, 
					"password"	=>$hash, 
					"status"	=>'A', 
					"dt_create"	=>$this->getDate()
					));
			if($result === 0){
			    $this->response("User information could not be saved. Try again.", 404);
			}else{
			    $this->response("Success", 200);  
			}
		}
    }

    function userupdate_post()
    {
    	$id 			= $this->post('id');
        $username      	= $this->post('username');
		$email     		= $this->post('email');

		if(!$id || !$username || !$email ){
		    $this->response("Enter complete user information to update", 400);
		}else{
			$result = $this->user_model->update($id,
				array(
					"username"	=>$username, 
					"email"		=>$email, 
					"status"	=>'A', 
					"dt_update"	=>$this->getDate()
					));
			if($result === 0){
			    $this->response("User information could not be saved. Try again.", 404);
			}else{
			    $this->response("Success", 200);  
			}
		}
    }

    function userdelete_post()
    {
        $id = $this->post('id');
		if(!$id){
		    $this->response("Enter complete user information to update", 400);
		}else{
			$result = $this->user_model->update($id,
				array(
					"status"	=>'D', 
					"dt_update"	=>$this->getDate()
					));
			if($result === 0){
			    $this->response("User information could not be saved. Try again.", 404);
			}else{
			    $this->response("Success", 200);  
			}
		}
    }

    function getDate(){
    	date_default_timezone_set('Asia/Kuala_Lumpur'); 
		$now = date('Y-m-d H:i:s');
		return $now;
    }
}
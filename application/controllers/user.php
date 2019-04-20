<?php
require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
 
class user extends REST_Controller {

	public function __construct() {
       parent::__construct();
       $this->load->model('user_model');
    }

    function usersbyid_get()
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

			date_default_timezone_set('Asia/Kuala_Lumpur'); 
			$now = date('Y-m-d H:i:s');
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$result = $this->user_model->add(
				array(
					"username"	=>$username, 
					"email"		=>$email, 
					"password"	=>$hash, 
					"status"	=>'A', 
					"dt_create"	=>$now
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
        // update an existing user and respond with a status/errors
    }

    function userdelete_post()
    {
        // update an existing user and respond with a status/errors
    }
}
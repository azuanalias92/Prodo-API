<?php
require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
 
class product extends REST_Controller {

	public function __construct() {
       parent::__construct();
       $this->load->model('product_model');
    }

    function productbyid_get()
    {
        $id  = $this->get('id');
        if(!$id){
            $this->response("No product specified", 400);
            exit;
        }
        $result = $this->product_model->getproductbyid($id);
        if($result){
            $this->response($result, 200); 
            exit;
        } 
        else{
         	$this->response("Invalid product", 404);
        	exit;
        }
    }

    function productadd_post()
    {
		$id_user      	= $this->post('id_user');
		$title     		= $this->post('title');
		$description    = $this->post('description');

		if(!$id_user || !$title || !$description){
		    $this->response("Enter complete product information to save", 400);
		}else{
			$result = $this->product_model->add(
				array(
					"id_user"		=>$id_user, 
					"title"			=>$title, 
					"description"	=>$description, 
					"status"		=>'A', 
					"dt_create"		=>$this->getDate()
					));
			if($result === 0){
			    $this->response("Product information could not be saved. Try again.", 404);
			}else{
			    $this->response("Success", 200);  
			}
		}
    }

    function productupdate_post()
    {
    	$id 			= $this->post('id');
		$title     		= $this->post('title');
		$description    = $this->post('description');

		if(!$id || !$title || !$description ){
		    $this->response("Enter complete product information to update", 400);
		}else{
			$result = $this->product_model->update($id,
				array(
					"title"				=>$title, 
					"description"		=>$description, 
					"status"			=>'A', 
					"dt_update"			=>$this->getDate()
					));
			if($result === 0){
			    $this->response("Product information could not be saved. Try again.", 404);
			}else{
			    $this->response("Success", 200);  
			}
		}
    }

    function productdelete_post()
    {
        $id  = $this->post('id');

		if(!$id){
		    $this->response("Enter complete product information to update", 400);
		}else{
			$result = $this->product_model->update($id,
				array(
					"status"	=>'D', 
					"dt_update"	=>$this->getDate()
					));
			if($result === 0){
			    $this->response("Product information could not be saved. Try again.", 404);
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
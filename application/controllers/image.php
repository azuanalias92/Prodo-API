<?php
require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
 
class image extends REST_Controller {

	public function __construct() {
       parent::__construct();
       $this->load->model('image_model');
    }

    function imagebyid_get()
    {
        $id  = $this->get('id');
        if(!$id){
            $this->response("No image specified", 400);
            exit;
        }
        $result = $this->image_model->getimagebyid($id);
        if($result){
            $this->response($result, 200); 
            exit;
        } 
        else{
         	$this->response("Invalid image", 404);
        	exit;
        }
    }

    function imageadd_post()
    {
		$id_product     = $this->post('id_product');
		$file_name     	= $this->post('file_name');

		if(!$id_product || !$file_name){
		    $this->response("Enter complete image information to save", 400);
		}else{
			$result = $this->image_model->add(
				array(
					"id_product"	=>$id_product, 
					"file_name"		=>$file_name,  
					"status"		=>'A', 
					"dt_create"		=>$this->getDate()
					));
			if($result === 0){
			    $this->response("Image information could not be saved. Try again.", 404);
			}else{
			    $this->response("Success", 200);  
			}
		}
    }

    function imageupdate_post()
    {
    	$id 			= $this->post('id');
		$id_product     = $this->post('id_product');
		$file_name    	= $this->post('file_name');

		if(!$id || !$id_product || !$file_name ){
		    $this->response("Enter complete image information to update", 400);
		}else{
			$result = $this->image_model->update($id,
				array(
					"id_product"	=>$id_product, 
					"file_name"		=>$file_name, 
					"status"		=>'A'
					));
			if($result === 0){
			    $this->response("Image information could not be saved. Try again.", 404);
			}else{
			    $this->response("Success", 200);  
			}
		}
    }

    function imagedelete_post()
    {
        $id  = $this->post('id');

		if(!$id){
		    $this->response("Enter complete image information to update", 400);
		}else{
			$result = $this->image_model->update($id,
				array(
					"status"	=>'D'
					));
			if($result === 0){
			    $this->response("Image information could not be saved. Try again.", 404);
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class RecuperacionController extends REST_Controller{

	function __construct(){
        parent::__construct();
        $this->load->model('recuperacionmodel');
    }

    public function index_get(){
    	//$tipo=$this->get("tipo");
    	$email=$this->post("email");
    	$dni=$this->post("dni");
    	$telefono=$this->post("telefono");
    	$contrasena=$this->post("pass");
    	//$array_out = array();

    	if($email!=null && $dni!=null && $telefono!=null && $contrasena!=null){
    		$id=$this->recuperacionmodel->comprobar_existencia($email,$dni,$telefono);
    		if($id!=false){
    			$respuesta=$this->recuperacionmodel->actualizar_pass($id,$contrasena);
                	if($respuesta==true){
                    		$array_out = array("result"=>"success");
               		}
                	else {
                    		$array_out = array("result"=>"error");
               		}

    		}
		else{
			$array_out = array("result"=>"no existe");
		}	

    	}
	else{
		$array_out = array("return"=>"failure");
	}

    	$this->response($array_out);


    }

}

?>

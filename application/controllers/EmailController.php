<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class EmailController extends REST_Controller{

		function __construct(){
            parent::__construct();
            $this->load->model('emailmodel');
    	}

    	public function index_get(){//le llega un email
    		
    		$email=$this->get("email");
            //echo $email;
    		if($email!=null){
    			$respuesta=$this->emailmodel->comprobar_contrasena($email);
                if($respuesta!=false){
                    //Correoooo
                      $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.gmail.com',
                        'smtp_port' => 587,
                        'smtp_user' => 'elena.nito398@gmail.com',
                        'smtp_pass' => '1a2b3c4d@',
                        'charset' => 'utf-8',
                        'wordwrap' => true,
                        'priority' => 1
                        );

                        $this->email->initialize($config);

                        $this->email->from('elena.nito398@gmail.com', 'SIGAP');
                        $this->email->to($email);
        
                        $this->email->subject('Restablecer contraseña');
                        $this->email->message($respuesta[0]['id_admin']);
        
                        $state = " ";
                        if($this->email->send())
                            $state="success";
                        else
                            $state="error";
 

                        $this->response(array("id_admin"=>$respuesta[0]['id_admin'],'state'=>$state));
                        
                }
                else {
                    $this->response(array("result"=>"error"));
                }
    			print_r($respuesta);
    		}	

    	}

        public function actualizar_get(){  //devolver al front
            $id=$this->get("id");
            $contrasena=$this->get("pass");

            echo $id;
            echo $contrasena;
            $array_out = array();

            if($id!=null & $contrasena!=null ){
                $respuesta=$this->emailmodel->actualizar_pass($id,$contrasena);
                if($respuesta==true){
                    $array_out = array("result"=>"success");
                }
                else {
                    $array_out = array("result"=>"error");
                }

            }

            $this->response($array_out);


        }
}

?>

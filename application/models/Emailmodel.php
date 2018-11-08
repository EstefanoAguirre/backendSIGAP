<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Emailmodel extends CI_Model
{
		function __construct(){
			parent::__construct();
		}

		public function comprobar_contrasena($email){
			$query=$this->db->query("select a.id_admin from usuario u,administrativo a,usuario_perfil up where a.email = ".$email." and a.id_usuario = up.id_usuario and up.id_usuario = u.id_usuario and (up.id_perfil = 1 or up.id_perfil = 2) and up.estado_up=true;");
			//print_r($query);
			$data=$query->result_array();
			//echo "sdfsdf".count($data);
			if(count($data)>0){
				return $data;

			} else {
				return false;

			}
			
		}

		public function actualizar_pass($id,$nuevapass){
			$this->db->query("update usuario set pass = ".$nuevapass." where id_usuario= (select id_usuario from administrativo where id_admin= ".$id.")");
			if ($this->db->affected_rows() > 0) {   
				return TRUE; 
			} else {   
				return FALSE; 
			}

		}



}



?>
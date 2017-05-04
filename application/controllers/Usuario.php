<?php
class Usuario extends CI_Controller {
	public function crearPost() {
		$this->load->model ( 'usuario_model' );
		$alias = $_POST ['alias'];
		$nombre = $_POST ['nombre'];
		$apellido = $_POST ['apellido'];
		$this->usuario_model->crearUsuario($alias,$nombre,$apellido);
	}
	
	public function editar() {		
	}
	
	public function logout() {	
	}
	
}
?>
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

	public function login(){
	    enmarcar($this,"forms/login");
    }
    public function loginPost(){
        //comprobar login en el modelo
        //activar sesión
        //llamar al home
    }
    public  function registrar(){
	    enmarcar($this,"forms/registro.php");
    }

    public  function registrarPost(){
        //llamar al modelo
        //comprobar usuario no existente
            //si no existe crear el usuario
                //iniciar la sesión
            //si ya existe notificar al usuario
                //no redirigir
    }

}
?>
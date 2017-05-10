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

    /**
     *
     */
    public function loginPost(){
        //recoger variables del post
        $usuario = $_POST['u'];
        $contraseña = $_POST['p'];
        //llamar al modelo
        $this->load->model('usuario_model');
        //comprobar usuario
        $hacerLogin = $this->usuario_model->login($usuario,$contraseña);
        if($hacerLogin){
            enmarcar($this,"forms/loginOk.php");
        }
        else{
            echo "ya las liao";
        }
        //activar sesión
        //llamar al home
    }
    public  function registrar(){
	    enmarcar($this,"forms/registro.php");
    }

    public  function registrarPost(){
        //recoger variables del post
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['tel'];
        $email = $_POST['email'];
        $alias = $_POST['u'];
        $contraseña = $_POST['p'];

        //llamar al modelo
        $this->load->model ( 'usuario_model' );
        //llamar al metodo de crear usuario en el modelo (Este método ya comprueba que no exista)
        $usuarioCreado = $this->usuario_model->crearUsuario($nombre,$apellidos,$telefono,$email,$alias,$contraseña);
            //si no existe crear el usuario
            if ($usuarioCreado){
                //iniciar la sesión
                enmarcar($this,"forms/registroOk.php");
            }
            //si ya existe notificar al usuario
            else{
                //redirigir a error de creación
                //DONE                añadir en la sesión algo que informe de que se intento registrar sin existo
                session_start();
                $_SESSION['errorRegistro']=true;
                enmarcar($this,"forms/registro.php");
            }
    }

}
?>
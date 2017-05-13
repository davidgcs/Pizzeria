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
        $aliasLogin = $this->usuario_model->login($usuario,$contraseña);
        if($aliasLogin != null){ //Login correcto
            //activar sesión
            //llamar al home
            session_start();
            $_SESSION['logeado']=true;
            $_SESSION['usuarioActual']=$usuario; //indicamos cual es el alias del usuario de la sesión actual.
            $_SESSION['errorLogin']=false;
            enmarcar($this,"home");
        }
        else{ //fallo al logearse
            session_start();
            $_SESSION['logeado']=false;
            $_SESSION['errorLogin']=true;
            enmarcar($this,"forms/login");
        }
    }
    public  function registrar(){
        $this->load->model('usuario_model');
        $usuariosExistentes = $this->usuario_model->getPrimaryKeys();
        $datos["registro"] = $usuariosExistentes;
        //mandamos la lista de correos y usernames para comprobar antes de intentar registrar al usuario
	    enmarcar($this,"forms/registro", $datos);
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
                session_start();
                $_SESSION['logeado']=true;
                $_SESSION['usuarioActual']=$alias;
                enmarcar($this,"forms/registroOk.php");
            }
            //si ya existe notificar al usuario
            else{
                //redirigir a error de creación
                //DONE                añadir en la sesión algo que informe de que se intento registrar sin existo
                header("location: registrar");
            }
    }

}
?>
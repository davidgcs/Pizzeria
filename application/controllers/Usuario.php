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
	session_start();
        $_SESSION['logeado']=false;
        session_destroy();
        header("location: " . base_url());
	}

	public function login(){
	session_start();
	    if (isset($_SESSION['logeado']) && $_SESSION["logeado"]==true){
	        echo "<script>console.log('Sesión encontrada cargando perfil.')</script>";
            header("location: ".base_url()."perfil");
        }
        else {
            echo "<script>console.log('No encuentro la sesión.')</script>";
            enmarcar($this, "forms/login");
        }
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
            $_SESSION['usuarioActual']=$aliasLogin; //indicamos cual es el alias del usuario de la sesión actual.
            $_SESSION['errorLogin']=false;
            header("location: " . base_url());
        }
        else{ //fallo al logearse
            session_start();
            $_SESSION['logeado']=false;
            $_SESSION['errorLogin']=true;
            enmarcar($this,"forms/login");
        }
    }
    public function registrar(){
        $datos['head']['css']=array("assets/css/usuario/registrar.css");
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
                enmarcar($this,"forms/registroOk.php");
            }
            //si ya existe notificar al usuario
            else{
                //redirigir a error de creación
                //DONE                añadir en la sesión algo que informe de que se intento registrar sin existo
                header("location: registrar");
            }
    }

    public function compruebaAlias(){
        extract($_REQUEST);
        $alias = $_REQUEST['alias'];

        //llamar al modelo
        $this->load->model ( 'usuario_model' );
        //comprobamos alias
        if ($this->usuario_model->existeUsuario($alias)) {
            devuelveDato("S");
        } else {
            devuelveDato("N");
        }
    }

    public function compruebaMail(){
        extract($_REQUEST);
        $email = $_REQUEST['email'];

        //llamar al modelo
        $this->load->model ( 'usuario_model' );
        //comprobamos email
        if ($this->usuario_model->existeEmail($email)) {
            devuelveDato("S");
        } else {
            devuelveDato("N");
        }
    }

}
?>

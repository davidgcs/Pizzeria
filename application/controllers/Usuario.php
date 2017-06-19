<?php

class Usuario extends CI_Controller{
    public function crearPost(){
        $this->load->model('usuario_model');
        $alias = $_POST ['alias'];
        $nombre = $_POST ['nombre'];
        $apellido = $_POST ['apellido'];
        $this->usuario_model->crearUsuario($alias, $nombre, $apellido);
    }

    public function logout(){
        session_start();
        $_SESSION['logeado'] = false;
        session_destroy();
        header("Location: " . base_url());
    }

    public function login(){
        session_start();
        //comprobamos login de admin
        if (isset($_SESSION['logeadoADM']) && $_SESSION["logeadoADM"] == true) {
            //hay sesion como admin iniciada, según sea empleado o admin mandamos a una u otra vista
            header("Location: " . base_url() . "admin");
        } else {
            //no hay sesion iniciada de admin, vemos si es inicio de sesion de usuario normal
            if (isset($_SESSION['logeado']) && $_SESSION["logeado"] == true) {
                $_SESSION['logeadoADM'] = false;
                header("Location: " . base_url() . "perfil");
            } else {
                $datos['head']['css'] = array("assets/css/usuario/login_style.css");
                //$datos['head']['js'] = array("assets/js/usuario/prefixfree.min.js");
                enmarcar($this, "forms/login", $datos);
            }
        }
    }

    public function loginPost(){
        //recoger variables del post
        $usuario = $_POST['u'];
        $contraseña = $_POST['p'];
        //llamar al modelo
        $this->load->model('usuario_model');
        //comprobar usuario
        $aliasLogin = $this->usuario_model->login($usuario, $contraseña);
        if ($aliasLogin != null) { //Login correcto
            //activar sesión
            session_start();
            $_SESSION['es_admin'] = $this->usuario_model->esAdministrador($aliasLogin);
            $_SESSION['es_empleado'] = $this->usuario_model->esEmpleado($aliasLogin);
            $_SESSION['usuarioActual'] = $aliasLogin; //indicamos cual es el alias del usuario de la sesión actual.
            $_SESSION['idUsuarioActual'] = $this->usuario_model->getIdAlias($aliasLogin); //indicamos cual es el alias del usuario de la sesión actual.
            $_SESSION['errorLogin'] = false;

            //comprobamos si es admin o empleado
            if ($_SESSION['es_empleado'] == true || $_SESSION['es_admin'] == true) {
                $_SESSION['logeado'] = false;
                $_SESSION['logeadoADM'] = true;
                header("Location: " . base_url() . "admin");
            } else {
                //login de cliente
                $_SESSION['logeado'] = true;
                $_SESSION['logeadoADM'] = false;
                header("Location: " . base_url() . "perfil");
            }
        } else { //fallo al logearse
            session_start();
            $_SESSION['logeado'] = false;
            $_SESSION['logeadoADM'] = false;
            $_SESSION['errorLogin'] = true;
            $datos['body']['usu'] = $usuario;
            $datos['body']['pass'] = $contraseña;
            $datos['head']['css'] = array("assets/css/usuario/login_style.css");
            //$datos['head']['js'] = array("assets/js/usuario/prefixfree.min.js");

            enmarcar($this, "forms/login", $datos);
        }
    }

    public function registrar(){
        $datos['head']['css'] = array("assets/css/usuario/login_style.css");
        //$datos['head']['js'] = array("assets/js/usuario/prefixfree.min.js");
        array_push($datos['head']['css'], "assets/css/usuario/registrar.css");
        enmarcar($this, "forms/registro", $datos);
    }

    public function registrarPost(){
        //recoger variables del post
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['tel'];
        $email = $_POST['email'];
        $alias = $_POST['u'];
        $contraseña = $_POST['p'];

        //llamar al modelo
        $this->load->model('usuario_model');
        //llamar al metodo de crear usuario en el modelo (Este método ya comprueba que no exista)
        $usuarioCreado = $this->usuario_model->crearUsuario($nombre, $apellidos, $telefono, $email, $alias, $contraseña, false);
        //si no existe crear el usuario
        if ($usuarioCreado) {
            $datos['head']['css'] = array("assets/css/usuario/login_style.css");
            enmarcar($this, "forms/login", $datos);
        } //si ya existe notificar al usuario
        else {
            //redirigir a error de creación
            //DONE                añadir en la sesión algo que informe de que se intento registrar sin existo
            header("Location: registrar");
        }
    }

    public function compruebaAlias(){
        extract($_REQUEST);
        $alias = $_REQUEST['alias'];

        //llamar al modelo
        $this->load->model('usuario_model');
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
        $this->load->model('usuario_model');
        //comprobamos email
        if ($this->usuario_model->existeEmail($email)) {
            devuelveDato("S");
        } else {
            devuelveDato("N");
        }
    }

    public function editPersonalInfo(){
        if(!isset($_SESSION))session_start();
        $aliasUsuarioActual = $_POST['aliasUsuarioActual'];
        $newNombre = $_POST['newNombre'];
        $newApellidos = $_POST['newApellidos'];
        $newTelefono =$_POST['newTelefono'];

        $this->load->model('usuario_model');
        $this->usuario_model->editPersonalInfo($aliasUsuarioActual,$newNombre,$newApellidos,$newTelefono);

        $_SESSION["editOK"]=true;
        header("Location:".base_url()."perfil");
    }

    public function editPassword(){
        if(!isset($_SESSION))session_start();
        $aliasUsuarioActual = $_POST['aliasUsuarioActual'];
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $newPasswordR = $_POST['newPasswordR'];

        $this->load->model('usuario_model');
        if($this->usuario_model->editPassword($aliasUsuarioActual,$oldPassword,$newPassword,$newPasswordR)){
            $_SESSION["editOK"]=true;
        }
        else{
            $_SESSION["editOK"]=false;
        }
        header("Location:".base_url()."perfil");
    }

    public function editDirection(){
        if(!isset($_SESSION))session_start();
        $aliasUsuarioActual = $_POST['aliasUsuarioActual'];
        $newCalle = $_POST['newCalle'];
        $newNumero = $_POST['newNumero'];
        $newCiudad = $_POST['newCiudad'];
        $newCP = $_POST['newCP'];

        $this->load->model('usuario_model');
        $this->usuario_model->editDirection($aliasUsuarioActual,$newCalle,$newNumero,$newCiudad,$newCP);

        $_SESSION["editOK"]=true;
        header("Location:".base_url()."perfil");
    }

}

?>

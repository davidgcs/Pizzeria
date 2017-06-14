<?php

class Admin extends CI_Controller
{
    public function index()
    {
        session_start();
        if (isset($_SESSION['logeadoADM']) && $_SESSION["logeadoADM"] == true) {
            if ($_SESSION['es_admin'] == true) {
                $datos['head']['css'] = array("assets/css/admin/admin.css");
                $datos['head']['js'] = array("assets/js/admin/admin.js");
                enmarcar($this, "admin/administracion", $datos);
            } elseif ($_SESSION['es_empleado'] == true) {
                $datos['head']['css'] = array("assets/css/admin/admin.css");
                $datos['head']['js'] = array("assets/js/admin/admin.js");
                enmarcar($this, "admin/empleado", $datos);
            }
        } else {
            header("location: " . base_url(). "usuario/login");
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION['logeadoADM'] = false;
        session_destroy();
        header("location: " . base_url());
    }

    public function login()
    {
        session_start();
        if (isset($_SESSION['logeadoADM']) && $_SESSION["logeadoADM"] == true) {
            //hay sesion como admin iniciada, según sea empleado o admin mandamos a una u otra vista
            if ($_SESSION['es_admin'] == true) {
                $datos['head']['css'] = array("assets/css/admin/admin.css");
                $datos['head']['js'] = array("assets/js/admin/admin.js");
                enmarcar($this, "admin/administracion", $datos);
            } elseif ($_SESSION['es_empleado'] == true) {
                $datos['head']['css'] = array("assets/css/admin/admin.css");
                $datos['head']['js'] = array("assets/js/admin/admin.js");
                enmarcar($this, "admin/empleado", $datos);
            }
        } else {
            //no hay sesion iniciada de admin, vemos si es inicio de sesion de usuario normal
            enmarcar($this, "admin/login");
        }
    }

    public function loginPost()
    {
        //recoger variables del post
        $usuario = $_POST['u'];
        $contraseña = $_POST['p'];
        //llamar al modelo
        $this->load->model('usuario_model');
        //comprobar usuario admin
        $aliasLogin = $this->usuario_model->loginADM($usuario, $contraseña);
        if ($aliasLogin) { //Login correcto
            //activar sesión de administracion y llamar a su respectiva vista
            session_start();
            $_SESSION['logeadoADM'] = true;
            $_SESSION['usuarioActual'] = $aliasLogin; //indicamos cual es el alias del usuario de la sesión actual.
            $_SESSION['es_admin'] = $this->usuario_model->esAdministrador($usuario);
            $_SESSION['es_empleado'] = $this->usuario_model->esEmpleado($usuario);
            $_SESSION['errorLogin'] = false;
            if ($_SESSION['es_empleado'] == true) {
                $datos['head']['css'] = array("assets/css/admin/empleado.css");
                $datos['head']['js'] = array("assets/js/admin/empleado.js");
                enmarcar($this, "admin/empleado", $datos);
            } else if ($_SESSION['es_admin'] == true) {
                $datos['head']['css'] = array("assets/css/admin/admin.css");
                $datos['head']['js'] = array("assets/js/admin/admin.js");
                enmarcar($this, "admin/administracion", $datos);
            }
        } else { //fallo al logearse
            session_start();
            $_SESSION['logeadoADM'] = false;
            $_SESSION['errorLogin'] = true;
            enmarcar($this, "admin/login");
        }
    }

    public function creaAdminTest()
    {
        $this->load->model("usuario_model");
        $this->usuario_model->creaUsuariosTest();

        header("location: " . base_url()."admin/login");
    }
}
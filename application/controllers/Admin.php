<?php

class Admin extends CI_Controller
{
    public function index()
    {
        header("location:" . base_url() . "admin/login");
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
            //hay sesion iniciada, segun sea empleado o admin mandamos a una u otra vista
            if ($_SESSION['es_admin'] == true) {
                enmarcar($this, "admin/administracion");
            } elseif ($_SESSION['es_empleado'] == true) {
                enmarcar($this, "admin/empleado");
            }
        } else {
            //no hay sesion iniciada
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
        //comprobar usuario
        $aliasLogin = $this->usuario_model->loginADM($usuario, $contraseña);
        if ($aliasLogin) { //Login correcto
            //activar sesión de administracion y llamar a su respectiva vista
            session_start();
            $_SESSION['logeadoADM'] = true;
            $_SESSION['usuarioActual'] = $aliasLogin; //indicamos cual es el alias del usuario de la sesión actual.
            $_SESSION['es_admin'] = $this->usuario_model->esAdministrador($usuario);
            $_SESSION['es_empleado'] = $this->usuario_model->esEmpleado($usuario);
            $_SESSION['errorLogin'] = false;

            header("location: " . base_url() . "admin/login");
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
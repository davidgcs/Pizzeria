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
                $datos['panel'] = $this->getDatosPanel("admin");
                enmarcar($this, "admin/administracion", $datos);
            } elseif ($_SESSION['es_empleado'] == true) {
                $datos['head']['css'] = array("assets/css/admin/admin.css");
                $datos['head']['js'] = array("assets/js/admin/admin.js");
                $datos['panel'] = $this->getDatosPanel("empleado");
                enmarcar($this, "admin/empleado", $datos);
            } else {
                header("Location: " . base_url() . "usuario/login");
            }
<<<<<<< HEAD
=======
        } else {
            header("Location: " . base_url(). "usuario/login");
>>>>>>> 42a28926b55e1efed1876fbe4378fde4134551db
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION['logeadoADM'] = false;
        session_destroy();
        header("Location: " . base_url());
    }

    public function getDatosPanel($rol)
    {
        //sea admin o empleado siempre gestiona pedidos y mensajes
        $this->load->model("pedido_model");
        $this->load->model("empresa_model");
        $panel['pedidos'] = $this->pedido_model->getDatosPanel();
        $panel['mensajes'] = $this->empresa_model->getDatosPanel();

        //si es admin ademas gestiona usuarios y productos
        if ($rol === 'admin') {
                $this->load->model("usuario_model");
                $this->load->model("producto_model");
                $panel['usuarios'] = $this->usuario_model->getDatosPanel();
                $panel['productos'] = $this->producto_model->getDatosPanel();
        }

        return $panel;
    }

    /*kk*/
    public function creaAdminTest()
    {
        $this->load->model("usuario_model");
        $this->usuario_model->creaUsuariosTest();

        header("location: " . base_url() . "admin/login");
    }
}
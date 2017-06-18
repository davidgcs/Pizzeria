<?php

class Admin extends CI_Controller
{
    public function index()
    {

        session_start();
        if (isset($_SESSION['logeadoADM']) && $_SESSION["logeadoADM"] == true) {
            if ($_SESSION['es_admin'] == true) {
                $datos['head']['css'] = array("assets/css/admin/gijgo.min.css");
                array_push($datos['head']['css'], "assets/css/admin/admin.css");
                $datos['head']['js'] = array("assets/js/admin/gijgo.min.js");
                array_push($datos['head']['js'], "assets/js/admin/admin.js");
                //$datos['panel'] = $this->getDatosPanel("admin");
                enmarcar($this, "admin/administracion", $datos);
            } elseif ($_SESSION['es_empleado'] == true) {
                $datos['head']['css'] = array("assets/css/admin/gijgo.min.css");
                array_push($datos['head']['css'], "assets/css/admin/admin.css");
                array_push($datos['head']['css'], "assets/css/admin/empleado.css");
                $datos['head']['js'] = array("assets/js/admin/gijgo.min.js");
                array_push($datos['head']['js'], "assets/js/admin/empleado.js");
                //$datos['panel'] = $this->getDatosPanel("empleado");
                enmarcar($this, "admin/empleado", $datos);
            }
        } else {
            header("Location: " . base_url() . "usuario/login");
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

        //header("location: " . base_url() . "admin/login");
    }

    public function listaUsuarios()
    {
        //carga al model
        $this->load->model("usuario_model");
        //devolvemos usuarios al js
        devuelveDato($this->usuario_model->getDatosPanel());
    }

    public function esEmpleado()
    {
        extract($_REQUEST);
        $alias = $_REQUEST['alias'];
        $this->load->model("usuario_model");
        if ($this->usuario_model->esEmpleado($alias)) {
            $respuesta = 1;
        } else {
            $respuesta = 0;
        }
        devuelveDato($respuesta);
    }

    public function setEmpleado()
    {
        extract($_REQUEST);
        $alias = $_REQUEST['alias'];
        $esEmp = $_REQUEST['esEmp'];
        $this->load->model("usuario_model");
        devuelveDato($this->usuario_model->setEmpleado($alias, $esEmp));
    }

    public function datosUsuJson()
    {
        extract($_REQUEST);
        $alias = $_REQUEST['alias'];
        $this->load->model("usuario_model");
        devuelveDato($this->usuario_model->getUsuJson($alias));
    }

    public function borraUsu()
    {
        extract($_REQUEST);
        $id = $_REQUEST['id'];
        $this->load->model("usuario_model");
        $this->usuario_model->borraUsu($id);
    }

    public function creaUsu()
    {
        extract($_REQUEST);
        $nombre = $_REQUEST['nombre'];
        $apellidos = $_REQUEST['apellidos'];
        $telefono = $_REQUEST['telefono'];
        $alias = $_REQUEST['alias'];
        $email = $_REQUEST['email'];
        $pass = $_REQUEST['pass'];
        $empleado = $_REQUEST['empleado'];

        $this->load->model("usuario_model");
        devuelveDato($this->usuario_model->crearUsuario($nombre, $apellidos, $telefono, $email, $alias, $pass, $empleado));

    }

    public function listaProductos()
    {
        //carga al model
        $this->load->model("producto_model");
        //devolvemos usuarios al js
        devuelveDato($this->producto_model->getDatosPanel());
    }

    public function borraProd()
    {
        extract($_REQUEST);
        $id = $_REQUEST['id'];
        $this->load->model("producto_model");
        $this->producto_model->borrarProducto($id);
    }

    public function updateProd()
    {
        extract($_REQUEST);
        $nref = $_REQUEST['nref'];
        $nombre = $_REQUEST['nombre'];
        $tipo = $_REQUEST['tipo'];
        $descri = $_REQUEST['descri'];
        $precio = $_REQUEST['precio'];

        $this->load->model("producto_model");
        $this->producto_model->updateProd($nref, $nombre, $tipo, $descri, $precio);
    }

    public function creaProd()
    {
        extract($_REQUEST);
        $nref = $_REQUEST['nref'];
        $nombre = $_REQUEST['nombre'];
        $tipo = $_REQUEST['tipo'];
        $descri = $_REQUEST['descri'];
        $precio = $_REQUEST['precio'];
        $imgsrc = $_REQUEST['imgsrc'];

        $this->load->model("producto_model");
        devuelveDato($this->producto_model->crearProducto($nombre, $tipo, $precio, $nref, $descri, $imgsrc));
    }

    public function listaPedidos()
    {
        //carga al model
        $this->load->model("pedido_model");
        //devolvemos usuarios al js
        devuelveDato($this->pedido_model->getDatosPanel());
    }

    public function setPedido() {
        session_start();
        $this->load->model("usuario_model");
        $idEmpleado = $this->usuario_model->getIdAlias($_SESSION['usuarioActual']);

        extract($_REQUEST);
        $idPedido = $_REQUEST['idPedido'];
        $estado = $_REQUEST['estado'];

        $this->load->model("pedido_model");
        devuelveDato($this->pedido_model->setPedido($idPedido, $idEmpleado, $estado));
    }

    public function getPedidoJson()
    {
        extract($_REQUEST);
        $id = $_REQUEST['id'];
        //carga al model
        $this->load->model("pedido_model");
        //devolvemos usuarios al js
        devuelveDato($this->pedido_model->getPedidoJson($id));
    }

    //borrar pedido
    public function borraPedido()
    {
        session_start();
        $this->load->model("usuario_model");
        $idEmpleado = $this->usuario_model->getIdAlias($_SESSION['usuarioActual']);

        extract($_REQUEST);
        $id = $_REQUEST['id'];
        $this->load->model("pedido_model");
        devuelveDato($this->pedido_model->borrarPedido($id, $idEmpleado));
    }

    public function listarMensajes()
    {
        //carga al model
        $this->load->model("empresa_model");
        //devolvemos usuarios al js
        devuelveDato($this->empresa_model->getDatosPanel());
    }

    public function borraMensaje()
    {
        extract($_REQUEST);
        $id = $_REQUEST['id'];
        $this->load->model("empresa_model");
        devuelveDato($this->empresa_model->borraMensaje($id));
    }
}
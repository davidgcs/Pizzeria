<?php
class Carrito extends CI_Controller{

    public function index(){
        procesar();
    }

    public function procesar(){
        if(!isset($_SESSION))session_start();
        $datos['head']['css']=array("assets/css/carrito/procesar.css");
        $datos["body"] = [];
        if(isset($_SESSION["usuarioActual"])){
            $this->load->model ( 'usuario_model' );
            $perfilUsuario = $this->usuario_model->getPerfil($_SESSION["usuarioActual"]);
            $datos["body"]["usuarioActual"] = $perfilUsuario;
        }

        enmarcar($this, "carrito/procesar",$datos);
    }

    public function addToCart(){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['carrito'])){
            $_SESSION['carrito']=[];
        }

        $nref = $_REQUEST['nref'];

        $this->load->model('producto_model');
        $producto = $this->producto_model->getProducto($nref);

        array_push($_SESSION['carrito'], $producto);
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        echo json_encode($producto);
    }

    public function deleteFromCart(){
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['carrito'])) {
            $nref = $_POST['nref'];

            foreach ($_SESSION['carrito'] as $k => $producto){
                echo "$nref ------> ".json_encode(array_values($producto)[0]['nref']);
                if(array_values($producto)[0]['nref'] == $nref){
                    unset($_SESSION['carrito'][$k]);
                }
            }

            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        }
    }
    public function addPersToCart(){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['carrito'])){
            $_SESSION['carrito']=[];
        }

        $nref = $_REQUEST['nref'];
        $ingredientes = $_REQUEST['ingredientes'];

        $this->load->model('producto_model');
        $producto = $this->producto_model->getProducto($nref);
        array_push($producto,$ingredientes);

        array_push($_SESSION['carrito'], $producto);
        print_r($_SESSION['carrito']);
    }

    public function crearPedido(){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['carrito'])){
            $_SESSION['carrito']=[];
        }
        $this->load->model("lineapedido_model");

        $lineasPedido = [];

        foreach ($_SESSION['carrito'] as $k=>$producto){
                $idLineaPedido = $this->lineapedido_model->crearLineaPedido(array_values($producto)[0]['nref'], 1, array_values($producto)[0]['precio']);
                $lineaPedido = $this->lineapedido_model->getLineaPedido($idLineaPedido);
                array_push($lineasPedido, $lineaPedido);
        }

        $this->load->model("pedido_model");
        if(isset($_SESSION['idUsuarioActual'])) {
            $this->pedido_model->registrarPedido($_SESSION['idUsuarioActual'],$lineasPedido);
        } else{
            $this->pedido_model->registrarPedido(0,$lineasPedido);
        }

        $_SESSION['carrito'] = [];
        header("Location: ".base_url()."perfil");
    }
}
?>
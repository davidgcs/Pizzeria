<?php
class Carrito extends CI_Controller{

    public function index(){
        pagar();
    }

    public function pagar(){

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
}
?>
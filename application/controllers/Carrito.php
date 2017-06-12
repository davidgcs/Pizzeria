<?php
class Carrito extends CI_Controller{

    public function index(){
        header("Location: ".base_url());
    }

    public function addToCart(){
        if(!isset($_SESSION)){
            session_start();
            $_SESSION['carrito']=[];
        }

        $nref = $_REQUEST['nref'];

        $this->load->model('producto_model');
        $producto = $this->producto_model->getProducto($nref);

        array_push($_SESSION['carrito'],$producto);
        echo $nref;
    }
}
?>
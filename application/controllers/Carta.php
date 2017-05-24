<?php

class Carta extends CI_Controller
{
    public function index()
    {
        $datos['datos'] = "CARTA";
        enmarcar($this, base_url() . "#carta", $datos);
    }


    public function pizza()
    {
        $this->load->model('producto_model');
        $datos['pizza'] = $this->producto_model->getProductosTipo("pizza");
        enmarcar($this, "carta/pizzas", $datos);
    }

    public function pizza2()
    {
        $this->load->model('producto_model');
        $datos['body']['pizza'] = $this->producto_model->getProductosTipo("pizza");
        enmarcar($this, "carta/pizza2", $datos);
    }

    public function hamburguesa()
    {
        $this->load->model('producto_model');
        $datos['hamburguesa'] = $this->producto_model->getProductosTipo("hamburguesa");
        enmarcar($this, "carta/hamburguesas", $datos);
    }

    public function sandwich()
    {
        $this->load->model('producto_model');
        $datos['sandwich'] = $this->producto_model->getProductosTipo("sandwich");
        enmarcar($this, "carta/sandwiches", $datos);
    }

    public function pasta()
    {
        $this->load->model('producto_model');
        $datos['pasta'] = $this->producto_model->getProductosTipo("pasta");
        enmarcar($this, "carta/pastas", $datos);
    }

    public function crearPizza()
    {
        $this->load->model('producto_model');
        $this->producto_model->crearProducto('PERSONALIZADA', 'pizza', "", "pizpers", "pizza1.png");
        $this->producto_model->crearProducto('MARGARITA', 'pizza', "", "pizmarg", "pizza2.png");
        $this->producto_model->crearProducto('BARBACOA', 'pizza', "", "pizbarb", "pizza3.png");
        $this->producto_model->crearProducto('CARNIVORA', 'pizza', "", "pizcarn", "pizza4.png");
        $this->producto_model->crearProducto('POLLO', 'pizza', "", "pizpoll", "pizza5.png");
        $this->producto_model->crearProducto('QUESERA', 'pizza', "", "pizques", "pizza6.png");
        $this->producto_model->crearProducto('BOLOGNESA', 'pizza', "", "pizbolog", "pizza7.png");
        $this->producto_model->crearProducto('BACON', 'pizza', "", "pizbaco", "pizza8.png");
        $this->producto_model->crearProducto('SALCHICHAS', 'pizza', "", "pizsalc", "pizza9.png");
    }
}

?>
<?php

class Carta extends CI_Controller
{
    public function index()
    {
        $datos['datos'] = "CARTA";
        enmarcar($this, base_url()."#carta",$datos);
    }


    public function pizza()
    {
        $this->load->model ( 'producto_model' );
        $datos['pizza'] = $this->producto_model->getProductosTipo("pizza");
        enmarcar($this, "carta/pizzas", $datos);
    }

    public function hamburguesa()
    {
        $this->load->model ( 'producto_model' );
        $datos['hamburguesa'] = $this->producto_model->getProductosTipo("hamburguesa");
        enmarcar($this, "carta/hamburguesas", $datos);
    }

    public function sandwich()
    {
        $this->load->model ( 'producto_model' );
        $datos['sandwich'] = $this->producto_model->getProductosTipo("sandwich");
        enmarcar($this, "carta/sandwiches", $datos);
    }

    public function pasta()
    {
        $this->load->model ( 'producto_model' );
        $datos['pasta'] = $this->producto_model->getProductosTipo("pasta");
        enmarcar($this, "carta/pastas", $datos);
    }
}

?>
<?php

class Carta extends CI_Controller
{
    public function index()
    {
        $datos['datos'] = "CARTA";
        header("Location: ".base_url() . "#carta");
    }


    public function pizza()
    {
        $this->load->model('producto_model');
        $datos['body']['pizza'] = $this->producto_model->getProductosTipo("pizza");
        $datos['head']['css'] = array("assets/css/carta/producto.css", "assets/css/carta/banner.css");
        $datos['head']['js'] = array("assets/js/carta/producto.js", "assets/js/carta/banner.js");
        enmarcar($this, "carta/pizzas", $datos);
    }

    public function hamburguesa()
    {
        $this->load->model('producto_model');
        $datos['body']['hamburguesa'] = $this->producto_model->getProductosTipo("hamburguesa");
        $datos['head']['css'] = array("assets/css/carta/producto.css");
        $datos['head']['js'] = array("assets/js/carta/producto.js");
        enmarcar($this, "carta/hamburguesas", $datos);
    }

    public function sandwich()
    {
        $this->load->model('producto_model');
        $datos['body']['sandwich'] = $this->producto_model->getProductosTipo("sandwich");
        $datos['head']['css'] = array("assets/css/carta/producto.css");
        $datos['head']['js'] = array("assets/js/carta/producto.js");
        enmarcar($this, "carta/sandwiches", $datos);
    }

    public function pasta()
    {
        $this->load->model('producto_model');
        $datos['body']['pasta'] = $this->producto_model->getProductosTipo("pasta");
        $datos['head']['css'] = array("assets/css/carta/producto.css");
        $datos['head']['js'] = array("assets/js/carta/producto.js");
        enmarcar($this, "carta/pastas", $datos);
    }

    public function crearProductos()
    {
        $this->load->model('producto_model');
        $this->producto_model->crearProducto('PERSONALIZADA', 'pizza', "12", "pizpers", "Crea la pizza a tu gusto.", "pizza5.png");
        $this->producto_model->crearProducto('MARGARITA', 'pizza', "12", "pizmarg", "La pizza más simple, y más barata.", "pizza1.png");
        $this->producto_model->crearProducto('COMPLETA', 'pizza', "18", "pizcomp", "¿No te decides? Que sea con todo.", "pizza2.png");
        $this->producto_model->crearProducto('QUESERA', 'pizza', "15", "pizques", "La quesera... ¿Qué será?", "pizza3.png");
        $this->producto_model->crearProducto('VEGETARIANA', 'pizza', "16", "pizvege", "La pizza más saludable.", "pizza4.png");
        $this->producto_model->crearProducto('PEPERONI', 'pizza', "14", "pizpepe", "Todo un clásico, la que comía Vitto Corleone.", "pizza6.png");
        $this->producto_model->crearProducto('IBÉRICA', 'pizza', "16", "piziber", "El auténtico sabor de la tierra.", "pizza7.png");
        $this->producto_model->crearProducto('BARBACOA', 'pizza', "15", "pizbarb", "Delicioso combinado de carnes con una salsa única.", "pizza8.png");
        $this->producto_model->crearProducto('CARBONARA', 'pizza', "15", "pizcarb", "Pizza con sabor a pasta... ¿Qué más se puede pedir?", "pizza9.png");
        $this->producto_model->crearProducto('DIABOLICA', 'pizza', "666", "pizdiab", "ERROR 404. Inteligencia not found.", "pizza10.png");
        $this->producto_model->crearProducto('MIXTO', 'sandwich', "3.5", "sanjamo", "El clásico sándwich, jamón y queso.", "dummy.png");
        $this->producto_model->crearProducto('VEGETAL', 'sandwich', "3.2", "sanvege", "El sándwich más saludable.", "dummy.png");
        $this->producto_model->crearProducto('COMPLETO', 'sandwich', "4", "sancomp", "Para bocas grandes, todas es todas.", "dummy.png");
        $this->producto_model->crearProducto('COMPLETA', 'hamburguesa', "5.5", "hamcomp", "¿Serás capaz de hincarle el diente? ¿Y a la hamburguesa también?", "dummy.png");
        $this->producto_model->crearProducto('POLLO CRUJIENTE', 'hamburguesa', "5", "hampoll", "Disfruta del crujiente pollo deshaciéndose en tu boca...", "dummy.png");
        $this->producto_model->crearProducto('DOBLE', 'hamburguesa', "7", "hamdobl", "¿Eres un glotón? Esta es tu hamburguesa.", "dummy.png");
        $this->producto_model->crearProducto('VEGETAL', 'hamburguesa', "4", "hamvege", "¿Te apetece cuidar la línea y comerte además una hamburguesa?", "dummy.png");
        $this->producto_model->crearProducto('BOLOGNESA', 'pasta', "8", "pasbolo", "Deliciosa pasta al dente, con una espectacular salsa bolognesa.", "dummy.png");
        $this->producto_model->crearProducto('CARBONARA', 'pasta', "7", "pascarb", "Descripcion de la pasta carbonara", "dummy.png");
        $this->producto_model->crearProducto('PESTO', 'pasta', "7.5", "paspest", "Descripcion de la pasta pesto", "dummy.png");
    }
}

?>
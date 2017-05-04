<?php

class Carta extends CI_Controller
{
    public function index()
    {
        $datos['datos'] = "CARTA";
        enmarcar($this, "errors/custom/obras",$datos);
    }


    public function pizza()
    {
        $datos['datos'] = "PIZZAS";
        enmarcar($this, "errors/custom/obras", $datos);
    }

    public function hamburguesa()
    {
        $datos['datos'] = "HAMBURGUESAS";
        enmarcar($this, "errors/custom/obras", $datos);
    }

    public function bocata()
    {
        $datos['datos'] = "BOCATAS";
        enmarcar($this, "errors/custom/obras", $datos);
    }

    public function pasta()
    {
        $datos['datos'] = "PASTAS";
        enmarcar($this, "errors/custom/obras", $datos);
    }
}

?>
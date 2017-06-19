<?php

class Empresa extends CI_Controller
{
    public function index()
    {
        $this->acerca();
    }

    public function contacto()
    {
        $datos['head']['css'] = array("assets/css/empresa/contacto.css");
        enmarcar($this, 'empresa/contacto', $datos);
    }

    public function enviarMensaje()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $remitente = $_POST['remitente'];
            $email = $_POST['email'];
            $mensaje = $_POST['mensaje'];

            $this->load->model('empresa_model');
            $this->empresa_model->guardarMensaje($mensaje, $remitente, $email);

            header('Location: '.base_url().'empresa/mensajeEnviado');
        }
        else{
            header('Location: '.base_url().'empresa/contacto');
        }

    }

    public function mensajeEnviado(){
        enmarcar($this, 'empresa/mensajeEnviado');
    }


    public function acerca()
    {
        $datos['head']['css'] = array("assets/css/empresa/acerca.css");
        $datos['head']['js'] = array("assets/js/empresa/acerca.js");
        enmarcar($this, "empresa/acerca", $datos);
    }
}

?>
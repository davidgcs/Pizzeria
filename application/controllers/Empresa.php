<?php

class Empresa extends CI_Controller
{
    public function index()
    {
        $this->acerca();
    }

    public function contacto()
    {
        enmarcar($this, 'empresa/contacto');
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
        enmarcar($this, "empresa/acerca");
    }
}

?>
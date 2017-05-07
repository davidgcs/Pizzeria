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

    public function enviarMail()
    {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $mensaje = $_POST['mensaje'];


    }


    public function acerca()
    {
        enmarcar($this, "empresa/acerca");
    }
}

?>
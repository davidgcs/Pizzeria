<?php

class Empresa extends CI_Controller
{
    public function index()
    {
        //this->about();
        $this->contacto();
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

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From: ' . $nombre . ' <' . $email . '>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


        //mail('daniserra14@gmail.com', 'mensaje de '.$nombre.' ('.$email.')', $mensaje, $headers);
    }
}

?>
<?php
class Empresa_model extends CI_Model {
    public function guardarMensaje($mensaje, $remitente, $email){
        $mensajeBean = R::dispense('mensaje');
        $mensajeBean['mensaje']=$mensaje;
        $mensajeBean['remitente']=$remitente;
        $mensajeBean['email']=$email;
        $id = R::store($mensajeBean);

        return $id;
    }
}
?>
<?php
class Empresa_model extends CI_Model {
    public function guardarMensaje($mensaje, $remitente, $email){
        $mensajeBean = R::dispense('mensaje');
        $mensajeBean['mensaje']=$mensaje;
        $mensajeBean['remitente']=$remitente;
        $mensajeBean['email']=$email;
        setlocale(LC_TIME, "es_ES");
        $mensajeBean['fecha'] = (strftime("%d/%m/%Y"));
        $id = R::store($mensajeBean);

        return $id;
    }

    public function getDatosPanel()
    {
        return json_encode(R:: getAll("select * from mensaje order by fecha"));
    }

    public function borraMensaje($id)
    {
        R::trash("mensaje", $id);
    }
}
?>
<?php
class Admin_model extends CI_Model {

    public function exportUsuarios(){
        $this->array_to_csv_download(R::getAll("select * from usuario"),"usuarios");
    }

    public function exportProductos(){
        $this->array_to_csv_download(R::getAll("select * from producto"),"productos");
    }

    public function exportPedidos(){
        $this->array_to_csv_download(R::getAll("select * from lineapedido, pedido where pedido_id = pedido.id"),"pedidos");
    }

    public function exportMensajes(){
        $this->array_to_csv_download(R::getAll("select * from mensaje"),"mensajes");
    }

    function array_to_csv_download($array,$name) {

        // filename for download
        $filename = "$name" . date('Ymd') . ".xls";

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");


        $flag = false;
        foreach($array as $row) {
            if(!$flag) {
                // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
            }
            echo implode("\t", array_values($row)) . "\r\n";
        }
        exit;

    }

}
?>
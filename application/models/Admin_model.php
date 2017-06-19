<?php
class Admin_model extends CI_Model {

    public function export($beans){
        $this->array_to_csv_download(R::getAll("select * from pedido"),"pedido");
        $this->array_to_csv_download(R::getAll("select * from ingredientes"),"ingredientes");
        $this->array_to_csv_download(R::getAll("select * from lineapedido"),"lineapedido");
        $this->array_to_csv_download(R::getAll("select * from producto"),"producto");
        $this->array_to_csv_download(R::getAll("select * from usuario"),"usuario");
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
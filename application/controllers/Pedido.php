<?php
class Pedido extends CI_Controller
{
    public function index()
    {
        $this->load->model("pedido_model");
        $this->pedido_model->creaPedidosTest();
    }
}
?>
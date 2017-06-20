<?php
class Perfil extends CI_Controller {
    public function index() {
        if(!isset($_SESSION))session_start();

        $this->load->model("pedido_model");
        $this->load->model ( 'usuario_model' );
        $datos['head']['css']=array("assets/css/perfil/perfil.css");
        $perfilUsuario = $this->usuario_model->getPerfil($_SESSION["usuarioActual"]);
        $datos['body']['pedidos']=$this->pedido_model->getPedidoPerfil($perfilUsuario['id']);
        $datos["body"]["usuarioActual"] = $perfilUsuario;

        enmarcar($this, "perfil/index",$datos);
    }

    public function detallesPedido()
    {
        extract($_REQUEST);
        $id = $_REQUEST['id'];
        $this->load->model("pedido_model");
        devuelveDato($this->pedido_model->detallesPedidoPerfil($id));
    }
}
?>
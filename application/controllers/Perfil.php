<?php
class Perfil extends CI_Controller {
    public function index() {
        if(!isset($_SESSION))session_start();

        $this->load->model("pedido_model");
        $datos['body']['pedidos']=$this->pedido_model->getDatosPanel();
        $datos['head']['css']=array("assets/css/perfil/perfil.css");

        if(isset($_SESSION["usuarioActual"])){
            $this->load->model ( 'usuario_model' );
            $perfilUsuario = $this->usuario_model->getPerfil($_SESSION["usuarioActual"]);
            $datos["body"]["usuarioActual"] = $perfilUsuario;
        }

        enmarcar($this, "perfil/index",$datos);
    }
}
?>
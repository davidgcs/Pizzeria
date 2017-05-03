<?php
class Usuario_model extends CI_Model {
	
	public function crearUsuario($alias,$nombre,$apellido) {
		if(!existeUsuario($alias)){
		
			$usuario = R::dispense("usuario");
			$usuario['alias']=$u;
			$usuario['alias']=$u;
			$usuario['alias']=$u;
		
		}
		else{
			//Notificar al usuario que el usuario ya existe..
		}
	}
	
	public function existeUsuario($alias) {
		return R::findOne ( 'usuario', 'alias = ?', [$alias] ) != null ? true : false;
	}
}
?>
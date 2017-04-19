<?php
Class Index extends CI_Controller{
	private function autenticado() {
		$autenticado = false;
		if (session_status () == PHP_SESSION_NONE) {
			session_start ();
		}
		if (isset ( $_SESSION ['empleado'] ['id'] )) {
			$autenticado = true;
		}
		return $autenticado;
	}
}
?>
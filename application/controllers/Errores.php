<?php
class Errores extends CI_Controller {
    public function e404() {
        enmarcar($this, 'errors/custom/obras.php');
    }
}
?>
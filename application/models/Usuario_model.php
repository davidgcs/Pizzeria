<?php
class Usuario_model extends CI_Model {
    public function crearUsuario($nombre,$apellidos,$telefono,$email,$alias,$contraseña) {
        if(!$this->existeUsuario($alias) && !$this->existeEmail($email)){

            $usuario = R::dispense("usuario");
            $usuario["nombre"] = $nombre;
            $usuario["apellidos"] = $apellidos;
            $usuario["telefono"] = $telefono;
            $usuario["email"] = $email;
            $usuario["alias"] = $alias;
            $usuario["password"] = md5($contraseña);
            R::store($usuario);
            return true;
        }
        else{
            //Notificar al usuario que el usuario ya existe..
            return false;
        }
    }
    public function login($usuario,$contraseña){
        if($this->existeUsuario($usuario)){
            //Se encontró el alias!! devolvemos el alias
            return $this->comprobarContraseña("alias",$usuario,$contraseña);
        }
        else if($this->existeEmail($usuario)){
            //Se encontró el email!! devolvemos el alias
            return $this->comprobarContraseña("email",$usuario,$contraseña);
        }
        else{
            //no se encuentra el alias ni el correo en la bbdd
            return false;
        }
    }
    private function existeUsuario($alias) {
        return R::findOne ( 'usuario', 'alias = ?', [$alias] ) != null ? true : false;
    }
    private function existeEmail($email){
        return R::findOne('usuario', 'email = ?', [$email]) != null ? true : false;
    }
    private function comprobarContraseña($tipoUsuario,$usuario,$contraseña){
        $pass =  R::findOne('usuario',"$tipoUsuario = '$usuario'")->password;
        if(md5($contraseña) == $pass){ //contraseña correcta
            if($tipoUsuario == "alias"){
                return $usuario;
            }
            else if($tipoUsuario == "email"){
                return $this->getUserAlias($usuario); //se le pasa el correo y recibe el alias
            }
        }
        else{
            return null;
        }
    }
    private function getUserAlias($email){
        return R::findOne('usuario', 'email = ?', [$email])->alias;
    }
    public function getPrimaryKeys(){
        $usuarios = R::findAll("usuario");
        $users = [];
        foreach ($usuarios as $usuario){
            $u['email'] = $usuario['email'];
            $u['alias'] = $usuario['alias'];
            array_push($users,$u);
        }
        return $users;
    }
}
?>
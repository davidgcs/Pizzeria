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
            R::close();
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
    public function existeUsuario($alias) {
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

    //FUNCIONES ADMINISTRACION
    public function loginADM($usuario, $contraseña)
    {
        if ($this->esAdministrador($usuario) || $this->esEmpleado($usuario)) {
            if ($this->existeUsuario($usuario)) {
                //Se encontró el alias!! devolvemos el alias
                return $this->comprobarContraseña("alias", $usuario, $contraseña);
            } else if ($this->existeEmail($usuario)) {
                //Se encontró el email!! devolvemos el alias
                return $this->comprobarContraseña("email", $usuario, $contraseña);
            } else {
                //no se encuentra el alias ni el correo en la bbdd
                return false;
            }
        } else {
            return false;
        }
    }

    public function esAdministrador($alias)
    {
        //compruebo alias
        $usuario = R::findOne('usuario', 'alias = ? and es_admin = ?', [$alias, true]) != null ? true : false;
        if (!$usuario) {
            //si el alias no coincide compruebo email
            return R::findOne('usuario', 'email = ? and es_admin = ?', [$alias, true]) != null ? true : false;
        } else {
            return $usuario;
        }
    }

    public function esEmpleado($alias)
    {
        //compruebo alias
        $usuario = R::findOne('usuario', 'alias = ? and es_empleado = ?', [$alias, true]) != null ? true : false;
        if (!$usuario) {
            //si el alias no coincide compruebo email
            return R::findOne('usuario', 'email = ? and es_empleado = ?', [$alias, true]) != null ? true : false;
        } else {
            return $usuario;
        }
    }

    //creacion de usuarios admin/admin, empleado/empleado y pizhub/pizhub
    public function creaUsuariosTest()
    {
        $usuario = R::dispense("usuario");
        $usuario["nombre"] = "admin";
        $usuario["apellidos"] = "admin";
        $usuario["telefono"] = "666666666";
        $usuario["email"] = "admin@pizhub.es";
        $usuario["alias"] = "admin";
        $usuario["password"] = md5("admin");
        $usuario->esAdmin = true;
        $usuario->esEmpleado = false;

        R::store($usuario);

        $empleado = R::dispense("usuario");
        $empleado["nombre"] = "empleado";
        $empleado["apellidos"] = "empleado";
        $empleado["telefono"] = "666666666";
        $empleado["email"] = "empleado@pizhub.es";
        $empleado["alias"] = "empleado";
        $empleado["password"] = md5("empleado");
        $empleado->esEmpleado = true;
        $empleado->esAdmin = false;

        R::store($empleado);

        $pizhub = R::dispense("usuario");
        $pizhub["nombre"] = "pizhub";
        $pizhub["apellidos"] = "pizhub";
        $pizhub["telefono"] = "666666666";
        $pizhub["email"] = "pizhub@pizhub.es";
        $pizhub["alias"] = "pizhub";
        $pizhub["password"] = md5("pizhub");
        $pizhub->esEmpleado = false;
        $pizhub->esAdmin = false;

        R::store($pizhub);
        R::close();
    }
}
?>
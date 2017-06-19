<?php

class Usuario_model extends CI_Model
{
    public function crearUsuario($nombre, $apellidos, $telefono, $email, $alias, $contraseña, $empleado)
    {
        if (!$this->existeUsuario($alias) && !$this->existeEmail($email)) {

            $usuario = R::dispense("usuario");
            $usuario["nombre"] = $nombre;
            $usuario["apellidos"] = $apellidos;
            $usuario["telefono"] = $telefono;
            $usuario["email"] = $email;
            $usuario["alias"] = $alias;
            $usuario["password"] = md5($contraseña);
            $usuario["es_empleado"] = $empleado;
            $usuario["es_admin"] = false;
            $usuario["calle"] = "";
            $usuario["numero"] = "";
            $usuario["ciudad"] = "";
            $usuario["cp"] = "";
            R::store($usuario);
            R::close();
            return true;
        } else {
            //Notificar al usuario que el usuario ya existe..
            return false;
        }
    }

    public function login($usuario, $contraseña)
    {
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
    }

    public function existeUsuario($alias)
    {
        return R::findOne('usuario', 'alias = ?', [$alias]) != null ? true : false;
    }

    public function existeEmail($email)
    {
        return R::findOne('usuario', 'email = ?', [$email]) != null ? true : false;
    }

    private function comprobarContraseña($tipoUsuario, $usuario, $contraseña)
    {
        $pass = R::findOne('usuario', "$tipoUsuario = '$usuario'")->password;
        if (md5($contraseña) == $pass) { //contraseña correcta
            if ($tipoUsuario == "alias") {
                return $usuario;
            } else if ($tipoUsuario == "email") {
                return $this->getUserAlias($usuario); //se le pasa el correo y recibe el alias
            }
        } else {
            return null;
        }
    }

    private function getUserAlias($email)
    {
        return R::findOne('usuario', 'email = ?', [$email])->alias;
    }

    public function getPrimaryKeys()
    {
        $usuarios = R::findAll("usuario");
        $users = [];
        foreach ($usuarios as $usuario) {
            $u['email'] = $usuario['email'];
            $u['alias'] = $usuario['alias'];
            array_push($users, $u);
        }
        return $users;
    }

    public function esAdministrador($alias)
    {
        return R::findOne('usuario', 'alias = ? and es_admin = ?', [$alias, true]) != null ? true : false;
    }

    public function esEmpleado($alias)
    {
        return R::findOne('usuario', 'alias = ? and es_empleado = ?', [$alias, true]) != null ? true : false;
    }

    //creacion de usuarios admin/admin, empleado/empleado y pizhub/pizhub
    public function creaUsuariosTest()
    {
        //borrar todos
        R::wipe('usuario');
        R::wipe("ingredientes");

        $usuario = R::dispense("usuario");
        $usuario["nombre"] = "admin";
        $usuario["apellidos"] = "admin";
        $usuario["telefono"] = "666666666";
        $usuario["email"] = "admin@pizhub.es";
        $usuario["alias"] = "admin";
        $usuario["password"] = md5("admin");
        $usuario["calle"] = "Falsa";
        $usuario["numero"] = "123";
        $usuario["cp"] = "28123";
        $usuario["ciudad"] = "Madrid";
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
        $empleado["calle"] = "alta";
        $empleado["numero"] = "2";
        $empleado["cp"] = "21111";
        $empleado["ciudad"] = "a";
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
        $pizhub["calle"] = "rara";
        $pizhub["numero"] = "288";
        $pizhub["cp"] = "28800";
        $pizhub["ciudad"] = "rotodosiana";
        $pizhub->esEmpleado = false;
        $pizhub->esAdmin = false;

        R::store($pizhub);

        $pizhub = R::dispense("usuario");
        $pizhub["nombre"] = "rico";
        $pizhub["apellidos"] = "pizhub";
        $pizhub["telefono"] = "666666666";
        $pizhub["email"] = "rico@pizhub.es";
        $pizhub["alias"] = "rico";
        $pizhub["password"] = md5("pizhub");
        $pizhub["calle"] = "esquina";
        $pizhub["numero"] = "90";
        $pizhub["cp"] = "27458";
        $pizhub["ciudad"] = "ficticia";
        $pizhub->esEmpleado = false;
        $pizhub->esAdmin = false;
        R::store($pizhub);


        $pizhub = R::dispense("usuario");
        $pizhub["nombre"] = "pizhub";
        $pizhub["apellidos"] = "pobre";
        $pizhub["telefono"] = "666666666";
        $pizhub["email"] = "pobre@pizhub.es";
        $pizhub["alias"] = "pobre";
        $pizhub["password"] = md5("pizhub");
        $pizhub["calle"] = "larga";
        $pizhub["numero"] = "9999";
        $pizhub["cp"] = "99900";
        $pizhub["ciudad"] = "carmín";
        $pizhub->esEmpleado = false;
        $pizhub->esAdmin = false;
        R::store($pizhub);


        $pizhub = R::dispense("usuario");
        $pizhub["nombre"] = "cliente";
        $pizhub["apellidos"] = "triste";
        $pizhub["telefono"] = "666666666";
        $pizhub["email"] = "triste@pizhub.es";
        $pizhub["alias"] = "triste";
        $pizhub["password"] = md5("pizhub");
        $pizhub["calle"] = "Falsa";
        $pizhub["numero"] = "55";
        $pizhub["cp"] = "28813";
        $pizhub["ciudad"] = "Serracines";
        $pizhub->esEmpleado = false;
        $pizhub->esAdmin = false;
        R::store($pizhub);

        $pizhub = R::dispense("usuario");
        $pizhub["nombre"] = "cliente";
        $pizhub["apellidos"] = "feliz";
        $pizhub["telefono"] = "666666666";
        $pizhub["email"] = "pizhub@pizhub.es";
        $pizhub["alias"] = "feliz";
        $pizhub["password"] = md5("pizhub");
        $pizhub["calle"] = "Falsa";
        $pizhub["numero"] = "321";
        $pizhub["cp"] = "28845";
        $pizhub["ciudad"] = "Ajalvir";
        $pizhub->esEmpleado = false;
        $pizhub->esAdmin = false;

        R::store($pizhub);

        $ingredientes = R::dispense("ingredientes");
        $ingredientes['nombre']="peperoni";
        $ingredientes['cantidad']= 85;
        R::store($ingredientes);

        $ingredientes = R::dispense("ingredientes");
        $ingredientes['nombre']="york";
        $ingredientes['cantidad']= 85;
        R::store($ingredientes);

        $ingredientes = R::dispense("ingredientes");
        $ingredientes['nombre']="salchichas";
        $ingredientes['cantidad']= 85;
        R::store($ingredientes);

        $ingredientes = R::dispense("ingredientes");
        $ingredientes['nombre']="carne";
        $ingredientes['cantidad']= 85;
        R::store($ingredientes);

        $ingredientes = R::dispense("ingredientes");
        $ingredientes['nombre']="pollo";
        $ingredientes['cantidad']= 85;
        R::store($ingredientes);

        $ingredientes = R::dispense("ingredientes");
        $ingredientes['nombre']="champiñones";
        $ingredientes['cantidad']= 85;
        R::store($ingredientes);

        $ingredientes = R::dispense("ingredientes");
        $ingredientes['nombre']="doble de queso";
        $ingredientes['cantidad']= 85;
        R::store($ingredientes);

        $ingredientes = R::dispense("ingredientes");
        $ingredientes['nombre']="aceitunas";
        $ingredientes['cantidad']= 85;
        R::store($ingredientes);

        $ingredientes = R::dispense("ingredientes");
        $ingredientes['nombre']="atún";
        $ingredientes['cantidad']= 85;
        R::store($ingredientes);

        $ingredientes = R::dispense("ingredientes");
        $ingredientes['nombre']="bacon";
        $ingredientes['cantidad']= 85;
        R::store($ingredientes);

        $ingredientes = R::dispense("ingredientes");
        $ingredientes['nombre']="Salsa BBQ";
        $ingredientes['cantidad']= 85;
        R::store($ingredientes);

        $ingredientes = R::dispense("ingredientes");
        $ingredientes['nombre']="piña";
        $ingredientes['cantidad']= 1;
        R::store($ingredientes);

        R::close();
    }

    public function getPerfil($alias){
        return R::findOne("usuario", "alias = ?", array($alias));
    }

    public function getUserId($alias){
        return R::findOne("usuario", "alias = ?", array($alias))["id"];
    }

    public function editPersonalInfo($aliasUsuarioActual,$newNombre,$newApellidos,$newTelefono){
        $user = R::load("usuario",$this->getUserId($aliasUsuarioActual));
        $user["nombre"]=$newNombre;
        $user["apellidos"]=$newApellidos;
        $user["telefono"]=$newTelefono;
        R::store($user);
    }

    public function editPassword($aliasUsuarioActual,$oldPassword,$newPassword,$newPasswordR){
        $user = R::load("usuario",$this->getUserId($aliasUsuarioActual));
        if(md5($oldPassword)==$user["password"] && $newPassword == $newPasswordR){
            $user["password"]=md5($newPassword);
            R::store($user);
            return true;
        }
        else{
            return false;
        }
    }

    public function editDirection($aliasUsuarioActual,$newCalle,$newNumero,$newCiudad,$newCP){
        $user = R::load("usuario",$this->getUserId($aliasUsuarioActual));
        $user["calle"]=$newCalle;
        $user["numero"]=$newNumero;
        $user["ciudad"]=$newCiudad;
        $user["cp"]=$newCP;
        R::store($user);
    }

    public function getDatosPanel()
    {
        return json_encode(R:: getAll("select id, alias, email, nombre, apellidos, direccion, cp, localidad, telefono, IF(es_empleado = 1, 'SI', 'NO') AS es_empleado from usuario where es_admin = 0 order by apellidos, nombre"));
    }

    public function getUsuJson($alias)
    {
        return '{"datosUsu": ' . json_encode(R:: getAll("select id, alias, email, nombre, apellidos, direccion, cp, localidad, telefono, IF(es_empleado = 1, 'SI', 'NO') AS es_empleado from usuario where alias = ?", array($alias))) . "}";
    }

    public function setEmpleado($alias, $esEmp)
    {
        $usuario = R::findOne('usuario', 'alias = ?', array($alias));
        $usuario->es_empleado = $esEmp;

        return R::store($usuario);
    }

    public function borraUsu($id)
    {
        R:: trash('usuario', $id);
    }

    public function getNomApe($id)
    {
        $usuario = R:: findOne("usuario", "id = ?", array($id));
        return $usuario['nombre']." ".$usuario['apellidos'];
    }

    public  function getIdAlias($alias) {
        $usuario = R:: findOne("usuario", "alias = ?", array($alias));
        return $usuario['id'];
    }

    public function getIngredientes(){
        return R::findAll("ingredientes");
    }

}

?>
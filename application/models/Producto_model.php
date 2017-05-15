<?php

class Producto_model extends CI_Model
{
    public function crearProducto($nombre, $tipo, $precio, $referencia)
    {
        if (!$this->existeProducto($referencia)) {

            $producto = R::dispense("producto");
            $producto->nombre = $nombre;
            $producto->tipo = $tipo;
            $producto->precio = $precio;
            $producto->referencia = $referencia;

            R::store($producto);
            return true;
        } else {
            //Notificar que el producto ya existe...
            return false;
        }
    }

    public function existeProducto($referencia)
    {
        return R::findOne('producto', 'referencia = ?', [$referencia]) != null ? true : false;
    }

    public function getProducto($referencia)
    {
        return R::load("producto", "referencia = ?", $referencia);
    }

    public function getProductos(){
        return R::loadAll("producto");
    }

    public function getProductosTipo($tipo)
    {
        return R::findAll("producto", "tipo = ?", [$tipo]);
    }

    public function setPrecio($referencia, $precio)
    {
        $producto = R::load("producto", "referencia = ?", $referencia);
        $producto->precio = $precio;
        R::store($producto);
    }

    public function setNombre($referencia, $nombre)
    {
        $producto = R::load("producto", "referencia = ?", $referencia);
        $producto->nombre = $nombre;
        R::store($producto);
    }

    public function borrarProducto($referencia)
    {
        $producto = R::load("producto", $referencia);
        R::trash($producto);
    }
}
<?php

class Producto_model extends CI_Model
{
    public function crearProducto($nombre, $tipo, $precio, $nref, $imgsrc)
    {
        if (!$this->existeProducto($nref)) {

            $producto = R::dispense("producto");
            $producto->nombre = $nombre;
            $producto->tipo = $tipo;
            $producto->precio = $precio;
            $producto->referencia = $nref;
            $producto->imgsrc = $imgsrc;

            R::store($producto);
            return true;
        } else {
            //Notificar que el producto ya existe...
            return false;
        }
    }

    public function existeProducto($nref)
    {
        return R::findOne('producto', 'referencia = ?', [$nref]) != null ? true : false;
    }

    public function getProducto($nref)
    {
        return R::load("producto", "referencia = ?", $nref);
    }

    public function getProductos(){
        return R::loadAll("producto");
    }

    public function getProductosTipo($tipo)
    {
        return R::findAll("producto", "tipo = ?", [$tipo]);
    }

    public function setPrecio($nref, $precio)
    {
        $producto = R::load("producto", "referencia = ?", $nref);
        $producto->precio = $precio;
        R::store($producto);
    }

    public function setNombre($nref, $nombre)
    {
        $producto = R::load("producto", "referencia = ?", $nref);
        $producto->nombre = $nombre;
        R::store($producto);
    }

    public function borrarProducto($nref)
    {
        $producto = R::load("producto", $nref);
        R::trash($producto);
    }
}
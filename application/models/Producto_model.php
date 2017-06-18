<?php

class Producto_model extends CI_Model
{
    public function crearProducto($nombre, $tipo, $precio, $nref, $descri, $imgsrc)
    {
        if (!$this->existeProducto($nref)) {

            $producto = R::dispense("producto");
            $producto->nombre = $nombre;
            $producto->tipo = $tipo;
            $producto->precio = $precio;
            $producto->nref = $nref;
            $producto->descri = $descri;
            $producto->imgsrc = $imgsrc;

            R::store($producto);
            R::close();
            return true;
        } else {
            //Notificar que el producto ya existe...
            return false;
        }
    }

    public function existeProducto($nref)
    {
        return R::findOne('producto', 'nref = ?', [$nref]) != null ? true : false;
    }

    public function getProducto($nref)
    {
        return R::find("producto", "nref = ?", array($nref));
    }

    public function getProductos()
    {
        return R::loadAll("producto");
    }

    public function getProductosTipo($tipo)
    {
        return R::findAll("producto", "tipo = ?", [$tipo]);
    }

    public function setPrecio($nref, $precio)
    {
        $producto = R::load("producto", "nref = ?", $nref);
        $producto->precio = $precio;
        R::store($producto);
        R::close();
    }

    public function setNombre($nref, $nombre)
    {
        $producto = R::load("producto", "nref = ?", $nref);
        $producto->nombre = $nombre;
        R::store($producto);
    }

    public function setDescri($nref, $descri)
    {
        $producto = R::load("producto", "nref = ?", $nref);
        $producto->descri = $descri;
        R::store($producto);
        R::close();
    }

    public function borrarProducto($id)
    {
        R::trash("producto", $id);
    }

    public function getPrecio($nref)
    {
        $producto = R::load("producto", $nref);
        return $producto->precio;
    }

    public function getDatosPanel()
    {
        return json_encode(R:: getAll("select * from producto order by tipo, nombre"));
    }

    public function updateProd($nref, $nombre, $tipo, $descri, $precio)
    {
        $producto = R::findOne("producto", "nref = ?", array($nref));
        $producto->nombre = $nombre;
        $producto->tipo = $tipo;
        $producto->descri = $descri;
        $producto->precio = $precio;

        R::store($producto);
        R::close();
    }
}
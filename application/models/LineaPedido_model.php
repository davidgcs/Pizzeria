<?php

/**
 * id
 * nrefProducto
 * cantidad
 * precioUnitario
 */
class LineaPedido_model extends CI_Model
{
    public function crearLineaPedido($nrefProducto, $cantidad, $precio)
    {

        $lineaPedido = R::dispense("lineaPedido");
        $lineaPedido->nrefProducto = $nrefProducto;
        $lineaPedido->cantidad = $cantidad;
        $lineaPedido->precioUnitario = $precio;

        return R::store($lineaPedido);
        R::close();
    }

    public function getLineaPedido($idLinea)
    {
        return R::load("lineaPedido", $idLinea);
    }

    public function borrarLineaPedido($idLinea)
    {
        $lineaPedido = R::load("lineaPedido", $idLinea);
        R::trash($lineaPedido);
    }
}
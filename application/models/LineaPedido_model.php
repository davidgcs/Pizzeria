<?php

/**
 * id
 * nrefProducto
 * cantidad
 * precioUnitario
 */
class LineaPedido_model extends CI_Model
{
    public function crearLineaPedido($nrefProducto, $cantidad, $precioUnitario)
    {

        $lineaPedido = R::dispense("lineaPedido");
        $lineaPedido->nrefProducto = $nrefProducto;
        $lineaPedido->cantidad = $cantidad;
        $lineaPedido->precioUnitario = $precioUnitario;

        return R::store($lineaPedido);
        R::close();
    }

    public function getLineaPedido($idLinea)
    {
        return R::load("lineaPedido", $idLinea);
    }

    public function getPrecioTotal($idLinea)
    {
        $lineaPedido = R:: load("lineaPedido", $idLinea);
        return (($lineaPedido->precioUnitario) * ($lineaPedido->cantidad));
    }

    public function borrarLineaPedido($idLinea)
    {
        $lineaPedido = R::load("lineaPedido", $idLinea);
        R::trash($lineaPedido);
    }
}
<?php
/**
 * id
 * nrefProducto
 * cantidad
 * precioUnitario
 */
class Lineapedido_model extends CI_Model
{
    public function crearLineaPedido($nrefProducto, $cantidad, $precio)
    {
        $lineaPedido = R::dispense("lineapedido");
        $lineaPedido->nrefProducto = $nrefProducto;
        $lineaPedido->cantidad = $cantidad;
        $lineaPedido->precioUnitario = $precio;
        return R::store($lineaPedido);
        R::close();
    }
    public function getLineaPedido($idLinea)
    {
        return R::load("lineapedido", $idLinea);
    }
    public function borrarLineaPedido($idLinea)
    {
        $lineaPedido = R::load("lineapedido", $idLinea);
        R::trash($lineaPedido);
    }

    /*public function getLineaPedidoDetalles($id)
    {
        //lineas pedido: nombre y nref producto, cantidad
        $linea = R::load("lineapedido", $id);

        $nombreProducto = R::findOne("producto", "nref = ?", array($linea->nref_producto));

        return array("nombreProducto" => )
    }*/

}
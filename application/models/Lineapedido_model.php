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
        $lineaPedido->nref_producto = $nrefProducto;
        $lineaPedido->cantidad = $cantidad;
        $lineaPedido->precio_unitario = $precio;
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

    public function borraLineasDePedido($id)
    {
        $lineas = R::find("lineapedido", "pedido_id = ?", array($id));
        R::trashAll($lineas);
    }

    /*public function getLineaPedidoDetalles($id)
    {
        //lineas pedido: nombre y nref producto, cantidad
        $linea = R::load("lineapedido", $id);

        $nombreProducto = R::findOne("producto", "nref = ?", array($linea->nref_producto));

        return array("nombreProducto" => )
    }*/

}
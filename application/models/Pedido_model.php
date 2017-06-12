<?php

/**
 * id
 * precioTotal
 * fecha
 * idCliente
 * idEmpleado
 * lineasPedido
 * estado
 */
class Pedido_model extends CI_Model
{
    public function registrarPedido($idCliente, $lineasPedido)
    {
        $pedido = R:: dispense("pedido");
        $pedido->idCliente = $idCliente;
        $pedido->idEmpleado = ""; /*pedido aún no aceptado por el empleado*/
        setlocale(LC_TIME, "es_ES");
        $pedido->fecha = (strftime("%d/%m/%Y"));
        $pedido->estado = "registrado";
        $precioTotal = 0;
        foreach ($lineasPedido as $lineaPedido) {
            $pedido->sharedLineaPedidoList[] = R::load('lineaPedido', $lineaPedido->id);
            $precioTotal += $lineaPedido->precioTotal;
        }
        $pedido->precioTotal = $precioTotal;

        $idPedido = R::store($pedido);
        R::close();

        return $idPedido;
    }

    public function asignarPedido($idPedido, $idEmpleado)
    {
        $pedido = R::load("pedido", $idPedido);
        $pedido->idEmpleado = $idEmpleado;
        $pedido->estado = "asignado";
        R::store($pedido);
        R::close();
    }

    public function cerrarPedido($idPedido)
    {
        $pedido = R::load("pedido", $idPedido);

        /*no se puede modificar el estado si el pedido está cerrado*/
        if ($pedido->estado != 'cerrado'){
            $pedido->estado = 'cerrado';

            R::store($pedido);
            R::close();

            return true;
        } else {
            return false;
        }
    }
}
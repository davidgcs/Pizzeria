<?php

/**
 * id
 * precioTotal
 * fecha
 * id_cliente
 * id_mpleado
 * lineasPedido
 * estado
 */
class Pedido_model extends CI_Model
{
    public function registrarPedido($idCliente, $lineaspedido)
    {
        $pedido = R:: dispense("pedido");
        $pedido->id_cliente = $idCliente;
        $pedido->id_empleado = ""; /*pedido aún no aceptado por el empleado*/
        setlocale(LC_TIME, "es_ES");
        $pedido->fecha = (strftime("%d/%m/%Y"));
        $pedido->estado = "registrado";
        $precioTotal = 0;
        foreach ($lineaspedido as $lineapedido) {
            $pedido->ownLineapedidoList[] = $lineapedido;
            $precioTotal += $lineapedido->precio_unitario;
        }
        $pedido->precio_total = $precioTotal;

        $idPedido = R::store($pedido);
        R::close();

        return $idPedido;
    }

    public function setPedido($idPedido, $idEmpleado, $estado)
    {
        $pedido = R::findOne("pedido", "id = ?", array($idPedido));
        if ($pedido->id_empleado == '' || $pedido->id_empleado == $idEmpleado) {
            $pedido->id_empleado = $idEmpleado;
            if ($pedido->estado != 'cerrado') {
                $pedido->estado = $estado;
                R::store($pedido);
                R::close();

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function creaPedidosTest()
    {
        //borramos tablas pedido y lineapedido
        R::wipe("pedido");
        R::wipe("lineapedido");
        $this->load->model("lineapedido_model");
        $idsLp = array($this->lineapedido_model->crearLineaPedido("pizbarb", 1, 15));
        array_push($idsLp, $this->lineapedido_model->crearLineaPedido("pizques", 2, 30));
        array_push($idsLp, $this->lineapedido_model->crearLineaPedido("pasbolo", 1, 8));
        $lps = array();
        foreach ($idsLp as $idLp) {
            array_push($lps, $this->lineapedido_model->getLineaPedido($idLp));
        }
        $this->registrarPedido(5, $lps);
    }

    public function getDatosPanel()
    {
       $this->load->model("usuario_model");
       $pedidosPre = R:: getAll("select pedido.id, pedido.fecha, pedido.estado, pedido.precio_total, pedido.id_empleado, pedido.id_cliente, usuario.alias from pedido, usuario where pedido.id_cliente = usuario.id order by FIELD(estado, 'registrado', 'asignado', 'preparado', 'cerrado')");
       $pedidos = array();
       foreach ($pedidosPre as $pedido) {
           $pedido['nombre_empleado'] = $this->usuario_model->getNomApe($pedido['id_empleado']);
           array_push($pedidos, $pedido);
       }
       return json_encode($pedidos);
    }

    public function getPedidoJson($id)
    {
        $this->load->model("usuario_model");
        $pedido = R:: getAll("select pedido.id, pedido.fecha, pedido.estado, pedido.precio_total, pedido.id_empleado, pedido.id_cliente, usuario.alias from pedido, usuario where pedido.id = ? and pedido.id_cliente = usuario.id", array($id));
        $nomApeEmp = $this->usuario_model->getNomApe($pedido[0]['id_empleado']);
        $pedido[0]['nombre_empleado'] = $nomApeEmp;

        return json_encode($pedido[0]);
    }

    public function borrarPedido($id, $idEmpleado)
    {
        $pedido = R::load("pedido", $id);

        if ($pedido->id_empleado === $idEmpleado || $pedido->id_empleado === "") {
            R::trash($pedido);
            return true;
        } else {
            return false;
        }

    }

    public function detallesPedido($id)
    {
        //nombre y alias del usu, fecha, nombre empleado, estado, precio
        $pedido = R::load("pedido", $id);

        $cliente = R::load("usuario", $pedido->id_cliente);

        $nomApeCliente = $cliente->nombre . " " . $cliente->apellidos;
        $aliasCliente = $cliente->alias;
        $emailCliente = $cliente->email;
        $telfCliente= $cliente->telefono;


        $empleado = R::load("usuario", $pedido->id_empleado);
        if ($empleado != null) {
            $nomEmple = $empleado->nombre . " " . $empleado->apellidos;
        } else {
            $nomEmple = "Pedido sin asignar";
        }

        return json_encode(array(
            "nombreCliente" => $nomApeCliente,
            "aliasCliente" => $aliasCliente,
            "nombreEmpleado" => $nomEmple,
            "emailCliente" => $emailCliente,
            "telfCliente" => $telfCliente
        ));
    }

    public function lineasPedido($id)
    {
        //lineas pedido: nombre y nref producto, cantidad
        $lineasPedido = R::find("lineapedido", "pedido_id = ?", array($id));

        $respuesta = array();

        foreach ($lineasPedido as $lin) {
            $producto = R::findOne("producto", "nref = ?", array($lin->nref_producto));
            $respuesta[$lin->id] = array("nombreProducto" => $producto->nombre, "nref" => $lin->nref_producto, "cantidad" => $lin->cantidad, "precio" => $producto->precio);
        }

        return json_encode($respuesta);
    }
}
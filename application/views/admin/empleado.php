<?php
/**
 * gestion de pedidos
 *  -asignacion/en proceso
 *  -finalizar pedidos
 *  -anular pedidos
 *
 * gestion productos
 *  -editar actuales (recetas)
 *  -registrar nuevos
 *  -borrar productos (informe al admin)
 *
 * gestion de almacen
 *  -añadir stock de ingredientes existentes
 *  -registrar nuevo ingrediente al almacen
 *  -eliminar ingredientes (informe al admin)
 */
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- It can be fixed with bootstrap affix http://getbootstrap.com/javascript/#affix-->
            <div id="sidebar" class="well sidebar-nav">
                <h5 style="color: red"><i class="glyphicon glyphicon-home"></i>
                    <small><b style="color: red">PANEL DE GESTIÓN</b></small>
                </h5>
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Add</a></li>
                    <li><a href="#">Search</a></li>
                </ul>
                <h5><i class="glyphicon glyphicon-user"></i>
                    <small><b>USERS</b></small>
                </h5>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">List</a></li>
                    <li><a href="<?=base_url()?>admin/logout" style="color: red">LOGOUT</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <!-- Content Here -->
        </div>
    </div>
</div>
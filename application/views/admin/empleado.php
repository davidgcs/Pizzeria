
<!--
 * gestion de pedidos
 *  -asignacion/en proceso
 *  -finalizar pedidos
 *  -anular pedidos
 *
 * gestion de mensajes contacto
 *  -visualizar mensajes
-->
<script>
    var url_index = "<?=base_url()?>";
</script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="tituloADM">PANEL DE CONTROL PIZHUB</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 panel-adm">
            <!-- It can be fixed with bootstrap affix http://getbootstrap.com/javascript/#affix-->
            <div id="sidebar" class="well sidebar-nav">
                <h5><i class="glyphicon glyphicon-home"></i>
                    <small><b style="color: red">ADMINISTRACION</b></small>
                </h5>
                <ul class="nav nav-pills nav-stacked" id="optADM">
                    <li id="optPed"><a href="#"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;Pedidos</a></li>
                    <li id="optMen"><a href="#"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Mensajes</a></li>
                    <li id="optOut"><a href="<?=base_url()?>admin/logout"><i class="glyphicon glyphicon-off"></i>&nbsp;Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10 tabla-adm">
            <div id="barra-superior">
                <input type="text" id="inpt-buscar">
                <button id="btnBuscar">Buscar</button>
                <button id="btnActualizar">Refrescar</button>
            </div>
            <table id="grid"></table>
        </div>
    </div>
    <!--PEDIDOS-->
    <div id="dialogPed" class="gj-display-none dialogAdmin">
        <input type="hidden" id="idPed"/>
        <form>
            <div>
                <label for="estadoPed" id="labelPed" class="labelSelect">Estado:</label>
                <select id="estadoPed" class="selectAuto">
                    <option value="registrado">Registrado</option>
                    <option value="asignado">Asignado</option>
                    <option value="preparado">Preparado</option>
                    <option value="cerrado">Cerrado</option>
                </select>
            </div>
            <div class="gj-margin-top-10" id="botonesDialog">
                <button type="button" id="btnSavePed" class="btn">Guardar</button>
            </div>
        </form>
    </div>
    <div id="detallesPedido" class="modal">
        <div class="container" style="border-bottom:1px solid white">
            <h2 id="fechaAliasPedido"></h2>
            <button type="button" class="close">X</button>
        </div>
        <hr>
        <ul class="container details">
            <li><p id="nombreClientePed"><span class="glyphicon glyphicon-user"></span></p></li>
            <li><p id="emailPed"><span class="glyphicon glyphicon-envelope"></span></p></li>
            <li><p id="telfPed"><span class="glyphicon glyphicon-earphone"></span></p></li>
            <li><p id="estadoPed"><span class="glyphicon glyphicon-cog"></span></p></li>
            <li><h3><span class="glyphicon glyphicon-th-list"></span>Lista de productos:</h3></li>
            <ul id="lineasPed" class="container">
                <!--nombreproducto, nrefproducto, cantidad-->
            </ul>
            <li><p id="precioPed"><span class="glyphicon glyphicon-euro"></span></p></li>
        </ul>
    </div>
    <!--MENSAJES-->
    <div id="detallesMensaje" class="modal">
        <div class="container" style="border-bottom:1px solid white">
            <h2 id="fechaMensaje"></h2>
            <button type="button" class="close">X</button>
        </div>
        <hr>
        <ul class="container details">
            <li><p id="remitenteMen"><span class="glyphicon glyphicon-user"></span></p></li>
            <li><p id="mailMen"><span class="glyphicon glyphicon-envelope"></span></p></li>
            <li><p id="textoMen"><span class="glyphicon glyphicon-pencil"></span></p></li>
        </ul>
    </div>
</div>
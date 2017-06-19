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
                    <li id="optUsu"><a href="#"><i class="glyphicon glyphicon-user"></i>&nbsp;Usuarios</a></li>
                    <li id="optPro"><a href="#"><i class="glyphicon glyphicon-cutlery"></i>&nbsp;Productos</a></li>
                    <li id="optPed"><a href="#"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;Pedidos</a></li>
                    <li id="optMen"><a href="#"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Mensajes</a></li>
                    <li id="optExp"><a href="#"><i class="fa fa-database"></i>&nbsp;Exportar</a></li>
                    <li id="optOut"><a href="<?= base_url() ?>admin/logout"><i class="glyphicon glyphicon-off"></i>&nbsp;Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-10 tabla-adm">
            <div id="barra-superior">
                <input type="text" id="inpt-buscar">
                <button id="btnBuscar">Buscar</button>
                <button id="btnActualizar">Refrescar</button>
                <button id="btnAdd">Añadir</button>
            </div>
            <table id="grid"></table>
        </div>
    </div>
    <!--USUARIOS-->
    <div id="dialogUser" class="gj-display-none">
        <input type="hidden" id="aliasEmp"/>
        <form>
            <div>
                <label for="idEmp" id="labelEmp">Empleado:</label>
                <select id="idEmp">
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
            <div class="gj-margin-top-10" id="botonesDialog">
                <button type="button" id="btnSave" class="btn">Guardar</button>
            </div>
        </form>
    </div>
    <div id="dialogCreaUser" class="gj-display-none">
        <form>
            <div>
                <label for="idNombreUsu">Nombre:</label>
                <input type="text" id="idNombreUsu">
                <label for="idApellidosUsu">Apellidos:</label>
                <input type="text" id="idApellidosUsu">
                <label for="idTelefonoUsu">Teléfono:</label>
                <input type="text" id="idTelefonoUsu">
                <label for="idAliasUsu">Alias:</label>
                <input type="text" id="idAliasUsu">
                <label for="idEmailUsu">Email:</label>
                <input type="text" id="idEmailUsu">
                <label for="idPassUsu">Contraseña</label>
                <input type="text" id="idPassUsu">
                <label for="idUsuEmp" id="labelUsuEmp">Empleado:</label>
                <select id="idUsuEmp">
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
            <div class="gj-margin-top-10" id="botonesDialog">
                <button type="button" id="btnSaveCrearUsu" class="btn">Crear</button>
            </div>
        </form>
    </div>
    <div id="detallesUser" class="modal">
        <div class="container" style="border-bottom:1px solid white">
            <h2 id="nomApeUsu"></h2>
            <button type="button" class="close">X</button>
        </div>
        <hr>
        <ul class="container details">
            <li><p id="aliasUsu"><span class="glyphicon glyphicon-user"></span></p></li>
            <li><p id="mailUsu"><span class="glyphicon glyphicon-envelope"></span></p></li>
            <li><p id="telfUsu"><span class="glyphicon glyphicon-earphone"></span></p></li>
            <li><p id="direUsu"><span class="glyphicon glyphicon-map-marker"></span></p></li>
        </ul>
    </div>
    <!--PRODUCTOS-->
    <div id="dialogEditProd" class="gj-display-none">
        <input type="hidden" id="idNrefProd"/>
        <form>
            <div>
                <label for="idNombreProd">Nombre:</label>
                <input type="text" id="idNombreProd">
                <label for="idTipoProd" id="labelTipoProd">Tipo:</label>
                <select id="idTipoProd">
                    <option value="pizza">Pizza</option>
                    <option value="sandwich">Sandwich</option>
                    <option value="hamburguesa">Hamburguesa</option>
                    <option value="pasta">Pasta</option>
                </select>
                <label for="idPrecioProd" id="labelPrecioProd">Precio:</label>
                <input type="text" id="idPrecioProd">
                <label for="idDescriProd">Descripción:</label>
                <textarea id="idDescriProd" rows="5"></textarea>
                <input type="hidden" id="idImgProd">
            </div>
            <div class="gj-margin-top-10" id="botonesDialog">
                <button type="button" id="btnSaveEditProd" class="btn">Guardar</button>
            </div>
        </form>
    </div>
    <div id="detallesProd" class="modal">
        <div class="container" style="border-bottom:1px solid white">
            <h2 id="nomProd"></h2>
            <button type="button" class="close">X</button>
        </div>
        <hr>
        <ul class="container details">
            <li><p id="tipoProd"><span class="glyphicon glyphicon-user"></span></p></li>
            <li><p id="precioProd"><span class="glyphicon glyphicon-envelope"></span></p></li>
            <li><p id="descriProd"><span class="glyphicon glyphicon-earphone"></span></p></li>
        </ul>
    </div>
    <div id="dialogCreaProd" class="gj-display-none">
        <form>
            <div>
                <label for="idNombreCreaProd">Nombre:</label>
                <input type="text" id="idNombreCreaProd">
                <label for="idNrefCreaProd">Referencia:</label>
                <input type="text" id="idNrefCreaProd">
                <label for="idTipoCreaProd" id="labelTipoProd">Tipo:</label>
                <select id="idTipoCreaProd">
                    <option value="pizza">Pizza</option>
                    <option value="sandwich">Sandwich</option>
                    <option value="hamburguesa">Hamburguesa</option>
                    <option value="pasta">Pasta</option>
                </select>
                <label for="idPrecioCreaProd" id="labelPrecioProd">Precio:</label>
                <input type="text" id="idPrecioCreaProd">
                <label for="idDescriCreaProd">Descripcion:</label>
                <textarea id="idDescriCreaProd" rows="5"></textarea>
            </div>
            <div class="gj-margin-top-10" id="botonesDialog">
                <button type="button" id="btnSaveCrearProd" class="btn">Crear</button>
            </div>
        </form>
    </div>
    <!--PEDIDOS-->
    <div id="dialogPed" class="gj-display-none dialogAdmin">
        <input type="hidden" id="idPed"/>
        <form>
            <div>
                <label for="estadoPedEdit" id="labelPed" class="labelSelect">Estado:</label>
                <select id="estadoPedEdit" class="selectAuto">
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
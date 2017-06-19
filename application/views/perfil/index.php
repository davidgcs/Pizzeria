<?php if (!isset($_SESSION) || !isset($body["usuarioActual"]))header("Location: " . base_url()) ?>

<style>
    footer {
        width: 100%;
        position: absolute;
        bottom: 0;
    }

    input {
        margin-bottom: 25px;
    }

    div#info, div#pass {
        width: 25%;
    }

    .btn-primary:hover, .btn-primary:focus {
        background-color: #265a88 !important;
    }

    ul.nav.nav-tabs{
        padding: 100px 100px 0 100px;
    }
    .error{
        border: 1px solid darkred !important;
    }
    #footer{
        position: relative !important;
    }

    p.description{
        color: #FFF;
    }
    table{
        color: #2e3842;
    }
</style>
<script>


        function checkPhone(evt){
            if(document.getElementById("tel").value.length < 9 || isNaN(document.getElementById("tel").value)){
                document.getElementById("tel").className += " error";
                return false;
            }
            return true;
        }


</script>
<div class="container" style="margin: 5% 3%">

    <h3>Pedidos</h3>
    <p class="description">En esta tabla se muestran los pedidos realizados. En verde se verán los pedidos en camino, en amarillo los pedidos en curso y en azul los pedidos que ya han terminado.</p>
    <table class="table">
        <thead>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <tr class="success">
            <td>Success</td>
            <td>Doe</td>
            <td>john@example.com</td>
        </tr>

        <tr class="info">
            <td>Info</td>
            <td>Dooley</td>
            <td>july@example.com</td>
        </tr>
        <tr class="warning">
            <td>Warning</td>
            <td>Refs</td>
            <td>bo@example.com</td>
        </tr>

        </tbody>
    </table>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#info">Información Personal</a></li>
        <li><a data-toggle="tab" href="#pass">Contraseña</a></li>
        <li><a data-toggle="tab" href="#dir">Dirección</a></li>
    </ul>

    <div class="tab-content">
        <div id="info" class="tab-pane fade in active">
            <form id="f1" onsubmit="return checkPhone();" action="usuario/editPersonalInfo" method="post">
                <h3>DATOS PERSONALES</h3>
                Nombre: <input type="text" name="newNombre" value="<?= $body["usuarioActual"]["nombre"] ?>">
                Apellidos: <input type="text" name="newApellidos" value="<?= $body["usuarioActual"]["apellidos"] ?>">
                Teléfono: <input id="tel" type="text" maxlength="9" name="newTelefono" value="<?= $body["usuarioActual"]["telefono"] ?>">
                <input type="hidden" name="aliasUsuarioActual" value="<?= $body["usuarioActual"]["alias"]?>">
                <button class="btn btn-primary" type="submit">Cambiar</button>
            </form>
        </div>
        <div id="pass" class="tab-pane fade">
            <form id="f2" action="usuario/editPassword" method="post">
            <h3>CONTRASEÑA</h3>
                Contraseña Actual: <input type="password" name="oldPassword">
                Nueva Contraseña: <input type="password" name="newPassword">
                Repetir Nueva Contraseña: <input type="password" name="newPasswordR">
                <input type="hidden" name="aliasUsuarioActual" value="<?= $body["usuarioActual"]["alias"]?>">
                <button class="btn btn-primary" type="submit">Cambiar</button>
            </form>
        </div>
        <div id="dir" class="tab-pane fade">
            <form id="f3" action="usuario/editDirection" method="post">
            <h3>Dirección</h3>
                Calle: <input type="text" name="newCalle" value="<?= $body["usuarioActual"]["calle"] ?>">
                Número: <input type="text" name="newNumero" value="<?= $body["usuarioActual"]["numero"] ?>">
                Ciudad: <input type="text" name="newCiudad" value="<?= $body["usuarioActual"]["ciudad"] ?>">
                Cod. Postal: <input type="text" maxlength="5" name="newCP" value="<?= $body["usuarioActual"]["cp"] ?>">
                <input type="hidden" name="aliasUsuarioActual" value="<?= $body["usuarioActual"]["alias"]?>">
                <button class="btn btn-primary" type="submit">Cambiar</button>
            </form>
        </div>
    </div>
    <?php if(isset($_SESSION['editOK'])&&$_SESSION['editOK']==true):?>
        <label id="ok">Los cambios se han guardado con éxito.</label>
    <?php elseif (isset($_SESSION['editOK'])&&$_SESSION['editOK']==false): ?>
        <label id="error">Error al realizar los cambios.</label>
    <?php else: ?>
    <?php endif;?>

    <?php $_SESSION['editOK']=null;?>
</div>
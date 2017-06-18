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
</style>
<div class="container" style="margin: 5% 3%">

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#info">Información Personal</a></li>
        <li><a data-toggle="tab" href="#pass">Contraseña</a></li>
        <li><a data-toggle="tab" href="#dir">Dirección</a></li>
    </ul>

    <div class="tab-content">
        <div id="info" class="tab-pane fade in active">
            <h3>DATOS PERSONALES</h3>
            Nombre: <input type="text" name="newNombre" value="<?= $body["usuarioActual"]["nombre"] ?>">
            Apellidos: <input type="text" name="newApellidos" value="<?= $body["usuarioActual"]["apellidos"] ?>">
            Teléfono: <input type="text" name="newTelefono" value="<?= $body["usuarioActual"]["telefono"] ?>">
            <button onclick="modificar(1)" class="btn btn-primary" type="button">Cambiar</button>
        </div>
        <div id="pass" class="tab-pane fade">
            <h3>CONTRASEÑA</h3>
            Contraseña Actual: <input type="password" name="oldPassword">
            Nueva Contraseña: <input type="password" name="newPassword">
            Repetir Nueva Contraseña: <input type="password" name="newPasswordR">
            <button onclick="modificar(2)" class="btn btn-primary" type="button">Cambiar</button>
        </div>
        <div id="dir" class="tab-pane fade">
            <h3>Dirección</h3>
            Calle: <input type="text" name="newCalle" value="<?= $body["usuarioActual"]["dirección"] ?>">
            Numero: <input type="text" name="newNumero" value="<?= $body["usuarioActual"]["dirección"] ?>">
            Ciudad: <input type="text" name="newCiudad" value="<?= $body["usuarioActual"]["dirección"] ?>">
            Cod. Postal: <input type="text" name="newCP" value="<?= $body["usuarioActual"]["dirección"] ?>">
            <button onclick="modificar(3)" class="btn btn-primary" type="button">Cambiar</button>
        </div>
    </div>
</div>
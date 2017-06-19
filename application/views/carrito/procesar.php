<form id="f3" action="usuario/editDirection" method="post">
    <h3>Dirección</h3>
    Calle: <input type="text" name="newCalle" value="<?= $body["usuarioActual"]["calle"] ?>">
    Número: <input type="text" name="newNumero" value="<?= $body["usuarioActual"]["numero"] ?>">
    Ciudad: <input type="text" name="newCiudad" value="<?= $body["usuarioActual"]["ciudad"] ?>">
    Cod. Postal: <input type="text" maxlength="5" name="newCP" value="<?= $body["usuarioActual"]["cp"] ?>">
    <input type="hidden" name="aliasUsuarioActual" value="<?= $body["usuarioActual"]["alias"]?>">
    <button class="btn btn-primary" type="submit">Cambiar</button>
</form>

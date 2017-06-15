<div class="container">
    <script>
        $(document).ready(function () {
            <?php if(isset($_SESSION['errorLogin']) && $_SESSION['errorLogin'] == true): ?>
            <?php $_SESSION['errorLogin'] = false; ?>
            $("#error").show();
            $("#error").effect("shake", {direction: "right", times: 4, distance: 10}, 400);
            <?php else: ?>
            $("#error").hide();
            <?php endif; ?>


        });
    </script>

    <div class="login">
        <h1>Login</h1>
        <form action="loginPost" method="post">
            <input type="text" name="u" placeholder="Usuario" required="required"
                   value="<?= isset($body['usu']) ? $body['usu'] : "" ?>"/>
            <input type="password" name="p" placeholder="Contraseña" required="required"/>
            <button type="submit" class="btn btn-primary btn-block btn-large">Iniciar Sesión</button>
        </form>
    </div>
    <div id="error" hidden>Usuario o contraseña incorrectos</div>
    <div id="loginToRegister">¿Aún no tienes cuenta? Haz click <u><a href="<?= base_url() ?>usuario/registrar">aquí</a></u>
        para registrarte.
    </div>
</div>

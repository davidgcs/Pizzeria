<div class="container">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/login_style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

<div class="login">
    <h1>Login</h1>
    <form method="post">
        <input type="text" name="u" placeholder="Usuario" required="required"/>
        <input type="password" name="p" placeholder="Contraseña" required="required"/>
        <button type="submit" class="btn btn-primary btn-block btn-large">Iniciar Sesión</button>
    </form>
</div>
    <div id="loginToRegister">¿Aún no tienes cuenta? Haz click <u><a href="<?= base_url()?>usuario/registrar">aquí</a></u> para registrarte.</div>
</div>

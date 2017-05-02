<?php

?>
<form action="<?= base_url()?>empresa/enviarMail" method="post">
    <div>
        <input type="text" name="nombre" placeholder="Nombre" required>
    </div>
    <div>
        <input type="email" name="email" placeholder="Email" required>
    </div>
    <div>
        <textarea name="mensaje" id="mensaje" cols="30" rows="10" placeholder="Comentarios" required></textarea>
    </div>
    <input type="submit" value="Enviar">
</form>

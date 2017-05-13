<div class="container">
	<h1>¡Ayúdanos a mejorar!</h1>
	<form id="formContacto" action="<?= base_url()?>empresa/enviarMensaje" method="post">
	    <div>
	        <input type="text" name="remitente" placeholder="Nombre" required>
	    </div>
	    <div>
	        <input type="email" name="email" placeholder="Email" required>
	    </div>
	    <div>
	        <textarea name="mensaje" id="mensaje" cols="30" rows="7" placeholder="Comentarios" required></textarea>
	    </div>
	    <input id="submit" type="submit" value="Enviar">
	</form>
</div>
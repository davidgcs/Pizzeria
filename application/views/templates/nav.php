

<nav class="container navbar navbar-inverse">
  <div class="navbar-header">
    <a class="navbar-brand" href="<?=base_url()?>"><img id="imgLogo" src="<?=base_url()?>assets/images/LogoPizHubTransp.png"> </a>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav pull-right">
    
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
           Carta <span class="caret"></span>
        </a>
		<ul class="dropdown-menu">
		  <li><a href="<?=base_url()?>carta/pizzas">Pizzas</a></li>
		  <li><a href="<?=base_url()?>carta/hamburguesas">Hamburguesas</a></li>
		  <li><a href="<?=base_url()?>carta/pastas">Pastas</a></li>
		  <li><a href="<?=base_url()?>carta/bocatas">Bocatas</a></li>
	     </ul>
      </li>
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
           Carrito<span class="caret"></span>
        </a>
		<ul class="dropdown-menu">
		  <li><a href="<?=base_url()?>ciudad/crear">Crear</a></li>
		  <li><a href="<?=base_url()?>ciudad/modificar">Modificar</a></li>
		  <li><a href="<?=base_url()?>ciudad/listar">Listar</a></li>
		  <li><a href="<?=base_url()?>ciudad/borrar">Borrar</a></li>
	     </ul>
      </li>
        <li>
            <a href="empresa/contacto">
                Contacto<span class="caret"></span>
            </a>
        </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
           Usuario<span class="caret"></span>
        </a>
		<ul class="dropdown-menu">
		  <li><a href="<?=base_url()?>usuario/editar">Editar</a></li>
		  <li><a href="<?=base_url()?>usuario/logout">Cerrar Sesión</a></li>
	    </ul>
      </li>
      
    </ul>
  </div>
</nav>



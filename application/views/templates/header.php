<header id="header" class="alt">
    <a href="<?=base_url()?>"><img src="<?= base_url() ?>assets/images/LogoPizHubTransp.png" alt="PizHub" id="logo_header"></a>
    <nav id="nav">
        <ul>
            <li class="special">
                <a href="#menu" class="menuToggle "><span>Menu</span></a>
                <div id="menu">
                    <ul>
                        <li><a href="<?=base_url()?>">Inicio</a></li>

                        <li><a href="<?php
                            echo ($this->uri->segment(1)==""||$this->uri->segment(1)=="home")?"":base_url() //escribe solo el anchor si estamos en home
                            ?>#carta" class="scrolly">Carta <?=uri_string()?></a></li>

                        <li><a href="<?php
                            echo ($this->uri->segment(1)==""||$this->uri->segment(1)=="home")?"":base_url() //escribe solo el anchor si estamos en home
                            ?>#localizacion" class="scrolly">¿Dónde estamos?</a></li>

<!--                        <li><a href="--><?//=base_url()?><!--#carta" class="scrolly">Carta</a></li>-->
                        <li><a href="<?=base_url()?>Usuario/login">Perfil</a></li>
                        <li><a href="<?=base_url()?>empresa/contacto">Contacto</a></li>
                        <li><a href="<?=base_url()?>empresa/acerca">Acerca de Nosotros</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
    <a href="<?= base_url() ?>Usuario/login"><i class="fa fa-user-circle"></i></a>
</header>
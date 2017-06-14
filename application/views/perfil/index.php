<?php if(!isset($_SESSION)||!isset($body["usuarioActual"]))header("Location: ".base_url())?>

<style>footer{width: 100%;position: absolute;bottom: 0;}</style>
<div class="container" style="margin: 5% 3%">
    <div id="avatar"></div>
    <h1><?= $body["usuarioActual"]["alias"]?></h1>
</div>
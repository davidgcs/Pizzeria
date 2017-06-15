<!DOCTYPE html >
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--STYLES-->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/pizzeria.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
    <link rel="icon" href="<?= base_url() ?>assets/images/LogoCircular.png"/>
    <!-- HOJAS PASADAS EN $datos-->
    <?php
    if (isset($head['css']))
        foreach ($head['css'] as $css) : ?>
            <link rel="stylesheet" href="<?= base_url() . $css ?>">
        <?php endforeach; ?>

    <!--SCRIPTS-->
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.scrollex.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.scrolly.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/skel.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/util.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/prefixfree.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/pizzeria.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/main.js"></script>
    <!-- HOJAS PASADAS EN $datos-->
    <?php
    if (isset($head['js']))
        foreach ($head['js'] as $js) : ?>
            <script type="text/javascript" src="<?= base_url() . $js ?>"></script>
        <?php endforeach; ?>

    <title>PizHub</title>
</head>
<body class="landing" onload="<?= (isset($head['onload']) ? $head['onload'] : '') ?>">
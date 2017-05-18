<!DOCTYPE html >
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--STYLES-->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/pizzeria.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.min.css">
    <?php if(file_exists(base_url()."assets/css/".uri_string().".css")):?>
    <link rel="stylesheet" href="<?=base_url()."assets/css/".uri_string().".css"?>"> <!-- CSS de la página actual-->
    <?php endif;?>
    <link rel="icon" href="<?=base_url()?>assets/images/LogoCircular.png" />


    <!--SCRIPTS-->
    <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/about.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/pizzeria.js"></script>


	<title>PizHub</title>
</head>
<body class="landing" onload="<?= (isset($head['onload']) ? $head['onload'] : '') ?>">
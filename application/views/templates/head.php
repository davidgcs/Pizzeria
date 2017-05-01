<!DOCTYPE html >
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--STYLES-->
	<link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/css/pizzeria.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">

    <!--SCRIPTS-->
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.scrollex.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.scrolly.min.js"></script>
    <script src="<?=base_url()?>assets/js/main.js"></script>
    <script src="<?=base_url()?>assets/js/skel.min.js"></script>
    <script src="<?=base_url()?>assets/js/util.js"></script>
	<title>PizHub</title>
</head>
<body onload="<?= (isset($head['onload']) ? $head['onload'] : '') ?>">

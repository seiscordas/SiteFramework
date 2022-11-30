<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<meta charset="utf-8">
<title>KL Systems: Controle de Clientes</title>

<link rel="shortcut icon" href="<?php echo base_url("favicon.ico");?>">

<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script src="<?php echo base_url("assets/bootstrap/js/respond.min.js");?>"></script>
<![endif]-->

<?php echo link_tag('assets/css/style.css')."\n"?>
<?php echo link_tag('assets/css/validationEngine.css')."\n"?>
<?php echo link_tag('assets/css/tablesorter_theme/blue/style.css')."\n"?>
<?php echo link_tag('assets/bootstrap/css/bootstrap.min.css')."\n"?>
<?php //echo link_tag('assets/bootstrap/css/bootstrap-responsive.min.css')."\n"?>
<?php echo link_tag('assets/jquery-ui/smoothness/jquery-ui.min.css')."\n"?>

<?php foreach($styleSheet as $cssrow):?>
<?php echo $cssrow;?>
<?php endforeach;?>

<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-ui.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/price_formar.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/mascara.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/alphanumeric.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validationEngine-pt_BR.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validationEngine.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/tablesorter.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/js/bootstrap.min.js");?>"></script>

<?php foreach($javaScript as $jrow):?>
<script type="text/javascript" src="<?php echo $jrow;?>"></script>
<?php endforeach;?>

<script type="text/javascript">
var path        = '<?php echo base_url();?>';
var current_url = '<?php echo current_url();?>';
</script>
<script type="text/javascript" src="<?php echo base_url("assets/js/configs.js");?>"></script>
</head>

<body>
<div id="tudo">
  <header>
    <!--menu-->
	<?php include_once("menu_view.php");?>
    <!--menu-->
  </header><!--header-->
<div class="conteudo">
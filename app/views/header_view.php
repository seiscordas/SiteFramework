<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title><?php echo $titulo_pag;?></title>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url('assets/images/favicon.ico');?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico');?>" type="image/x-icon" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Kleber Martins: KL Systems">
    
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css');?>" >
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
    
    <?php if(!empty($styleSheet)):?>
	<?php foreach($styleSheet as $rowStyleSheet):?>
    <link rel="stylesheet" href="<?php echo base_url($rowStyleSheet);?>">
    <?php endforeach;?>
    <?php endif;?>
    
	<script src="<?php echo base_url('assets/js/jquery.js');?>"></script>
    
    <?php if(!empty($javaScript)):?>
    <?php foreach($javaScript as $rowjavaScript):?>
    <script src="<?php echo base_url($rowjavaScript);?>"></script>
    <?php endforeach;?>
    <?php endif;?>

    <!--[if (gt IE 9)|!(IE)]><!-->
        <script src="<?php echo base_url('assets/js/jquery.mobile.customized.min.js');?>"></script>
    <!--<![endif]-->
    
    <?php if(!empty($jsLoads)):?>
    <script>$(window).load( function(){<?php echo $jsLoads;?>});</script>
    <?php endif;?>
    
    <!--[if lt IE 9]>
    <div style='text-align:center'><a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div>  
    <script src="<?php echo base_url('assets/js/html5shiv.js');?>"></script> 
    <script src="<?php echo base_url('assets/js/respond.min.js');?>"></script>
  <![endif]-->
</head>

<body>
<!--==============================header=================================-->
    <header id="header">
      <h1><a href="<?php echo base_url('home');?>"><img alt="Logo" src="<?php echo base_url('assets/images/logo_header.jpg');?>"></a></h1>
      <hr class="line1">
      <nav class="nav-prin>
        <ul class="nav sf-menu">
          <li <?php if($nav == 'home')echo ' class="active"';?>><a href="<?php echo base_url('home');?>">HOME<span></span><em class="indicator1->del"></em></a></li>
          <li <?php if($nav == 'sobre')echo ' class="active"';?>><a href="<?php echo base_url('sobre');?>">SOBRE NÓS<span></span></a></li>
          <li <?php if($nav == 'servico')echo ' class="active"';?>><a href="<?php echo base_url('servico');?>">NOSSOS SERVIÇOS<span></span></a></li>
          <li <?php if($nav == 'produto')echo ' class="active"';?>><a href="<?php echo base_url('produto');?>">PRODUTOS<span></span></a></li>
          <li <?php if($nav == 'contato')echo ' class="active"';?>><a href="<?php echo base_url('contato');?>">CONTATO<span></span></a></li>
        </ul>
      </nav>
  </header>
<!--==============================content=================================-->
<div id="content">
<!doctype html>
<html>
<head>
<title>KL Systems: Controle de Clientes</title>

<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo base_url("favicon.ico");?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php echo link_tag('assets/css/style.css') . "\n";?>
<!-- Bootstrap -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="<?php echo base_url("assets/bootstrap/js/html5shiv.js");?>"></script>
  <script src="<?php echo base_url("assets/bootstrap/js/respond.min.js");?>"></script>
<![endif]-->

<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js");?>"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>

<body>
<div class="conteudo">
  <div id="kl">
    <img src="<?php echo base_url('assets/images/kl-logo.jpg');?>" alt="kl-logo" title="KL Systems">
    <h1>KL Systems</h1>
  </div>	
  <div id="login">
    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?php echo form_open('verificalogin','class="form-horizontal" role="form"'); ?>
      <fieldset>
        <legend><h1>Login</h1></legend>  
          <div class="form-group">
            <label for="usuario" class="col-lg-2 control-label">Usuário:</label>
            <div class="col-lg-10">
              <input type="text" name="usuario" id="usuario" class="form-control to-upper">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Senha:</label>
            <div class="col-lg-10">
              <input type="password" name="senha" class="form-control"> 
            </div>
          </div>         
          <p><input type="submit" name="logar" value="Entrar" class="btn btn-default"></p>
      </fieldset>  
    </form>
  </div><!--login-->
</div><!-- conteudo -->
</body>
</html>
<script type="text/javascript">
// Transforma texto imput em Maiusculo
$(function(){
	$(".to-upper").bind('keyup blur',function() {
		$(this).val($(this).val().toUpperCase());
	});
});
</script>
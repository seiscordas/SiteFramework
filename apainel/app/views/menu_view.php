<?php $usuario = $this->session->userdata('logged_in');?>
<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav" role="menu">
      <!-- Home -->
      <li class="<?php if($this->uri->segment(1) == 'home') echo 'active';?>">
        <a href="<?php echo base_url('home');?>" title="Home" class="inf-tooltip" data-placement="bottom"><span class="glyphicon glyphicon-home"></span></a>
      </li>
      <!-- Categorias -->
      <li class="<?php if($this->uri->segment(1) == 'categoria') echo 'active';?>">
        <a href="<?php echo base_url('categoria/lista/A');?>" title="Categoria" class="inf-tooltip" data-placement="bottom"><span class="glyphicon glyphicon-duplicate"></span></a>
      </li>
      <!-- produto -->
      <li class="<?php if($this->uri->segment(1) == 'produto') echo 'active';?>">
        <a href="<?php echo base_url('produto/lista/A');?>" title="Produto" class="inf-tooltip" data-placement="bottom"><span class="glyphicon glyphicon-book"></span></a>
      </li>
      <!-- evento -->
      <li class="<?php if($this->uri->segment(1) == 'evento') echo 'active';?>">
        <a href="<?php echo base_url('evento/lista/A');?>" title="Evento" class="inf-tooltip" data-placement="bottom"><span class="glyphicon glyphicon-calendar"></span></a>
      </li>
      <!-- portifolio -->
      <li class="<?php if($this->uri->segment(1) == 'portifolio') echo 'active';?>">
        <a href="<?php echo base_url('portifolio/lista/A');?>" title="Portifólio" class="inf-tooltip" data-placement="bottom"><span class="glyphicon glyphicon-briefcase"></span></a>
      </li>
      <!-- depoimento -->
      <li class="<?php if($this->uri->segment(1) == 'depoimento') echo 'active';?>">
        <a href="<?php echo base_url('depoimento/lista/A');?>" title="Depoimento" class="inf-tooltip" data-placement="bottom"><span class="glyphicon glyphicon-comment"></span></a>
      </li>
      <!-- Galeria -->
      <li>
        <a href="<?php echo base_url('galeria/lista/A');?>" class="img-modal inf-tooltip" data-placement="bottom" title="Galerias"><span class="glyphicon glyphicon-folder-open"></span></a>
      </li>
      <!-- Imagens -->
      <li>
        <a href="<?php echo base_url('imagem/lista/?usar_img=n');?>" class="img-modal inf-tooltip ajax-modal" data-placement="bottom" data-toggle="img-modal" title="Imagens"><span class="glyphicon glyphicon-picture"></span></a>
      </li>
      <!-- Usuário -->
      <li class="dropdown">
        <a href="#" class="dropdown-toggle inf-tooltip" data-toggle="dropdown" title="Usuários" class="inf-tooltip" data-placement="bottom"><span class="glyphicon glyphicon-lock"></span><b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url('usuario/lista/A');?>"><span class="glyphicon glyphicon-list"></span> Listar</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo base_url('usuario/form_add/A');?>" ><span class="glyphicon glyphicon-plus"></span> Adicionar</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo base_url("sair");?>" class="inf-tooltip" title="Sair"><span class="glyphicon glyphicon-off"></span></a></li>
    </ul>
  </div><!-- /.navbar-collapse -->
  <div class="clear"></div>
</nav>
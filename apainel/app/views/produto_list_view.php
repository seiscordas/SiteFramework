<div>
  <div class="col-lg-3 col-md-3 col-sm-4">
    <a href="<?php echo base_url('home');?>" class="btn btn-default inf-tooltip" title="Cancelar">
      <span class="glyphicon glyphicon-arrow-left"></span>
    </a>    
    <?php if($status == 'A'):?>
    <a href="<?php echo base_url('produto/form_add/'.$status);?>" class="btn btn-default inf-tooltip ajax-modal" data-toggle="add-prod" data-target="#add-prod" title="Nova Categoria">
      <span class="glyphicon glyphicon-plus"></span>
    </a>
    <?php endif;?>
    <a href="<?php echo base_url('produto/lista/'.$goStatus);?>" class="btn btn-default inf-tooltip" title="Listar <?php echo $goStatusTxt;?>">
      <span class="glyphicon glyphicon-<?php echo ($goStatus == 'I')? 'eye-close' : 'eye-open';?>"></span>
    </a>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-6">
    <form action="<?php echo base_url('produto/busca/');?>" class="form-ajax" role="form" method="post">
      <!--hidden-->
      <input name="status" type="hidden" value="<?php echo $status;?>">
      <!--hidden-->
      <div class="form-group">
        <div class="input-group">
          <input name="termo" type="text" class="pesq_key_ajax form-control" id="input-termo" placeholder="Procurar Produto">
          <span class="input-group-btn">
            <button class="btn btn-default pesq_btn_ajax" type="button"><span class="glyphicon glyphicon-search"></span></button>
          </span>
        </div><!-- /input-group -->  
      </div>
      
    </form>
  </div>
  <div class="clearfix"></div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">
    Lista de Produto <?php echo $statusTxt;?>
  </div>
  <div class="panel-body">
    <?php if(!$dados):?>
    Não há dados!
    <a href="<?php echo base_url('home');?>" class="btn btn-default inf-tooltip" title="Voltar">
      <span class="glyphicon glyphicon-arrow-left"></span>
    </a>
    <?php else:?>
    <div class="pg-ajax">
      <?php include('produto_list_ajax_view.php');?>
    </div><!-- pg ajax-->
    <?php endif;?>
  </div>
</div>
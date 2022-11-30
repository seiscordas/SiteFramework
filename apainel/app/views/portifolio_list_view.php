<div>
  <div class="col-lg-3 col-md-3 col-sm-4">
    <a href="<?php echo base_url('home');?>" class="btn btn-default inf-tooltip" title="Cancelar">
      <span class="glyphicon glyphicon-arrow-left"></span>
    </a>    
    <?php if($status == 'A'):?>
    <a href="<?php echo base_url('portifolio/form_add/'.$status);?>" class="btn btn-default inf-tooltip ajax-modal" data-toggle="add-event" data-target="#add-event" title="Novo Categoria">
      <span class="glyphicon glyphicon-plus"></span>
    </a>
    <?php endif;?>
    <a href="<?php echo base_url('portifolio/lista/'.$goStatus);?>" class="btn btn-default inf-tooltip" title="Listar <?php echo $goStatusTxt;?>">
      <span class="glyphicon glyphicon-<?php echo ($goStatus == 'I')? 'eye-close' : 'eye-open';?>"></span>
    </a>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-6">
    <form action="<?php echo base_url('portifolio/busca/');?>" class="form-ajax" role="form" method="post">
      <!--hidden-->
      <input name="status" type="hidden" value="<?php echo $status;?>">
      <!--hidden-->
      <div class="form-group">
        <div class="input-group">
          <input name="termo" type="text" class="pesq_key_ajax form-control" id="input-termo" placeholder="Procurar Portifolio">
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
    Lista de Portifolio <?php echo $statusTxt;?>
  </div>
  <div class="panel-body">
    
    <div class="pg-ajax">
    <?php if(!$dados):?>
    Não há dados!
    <a href="<?php echo base_url('home');?>" class="btn btn-default inf-tooltip" title="Voltar">
      <span class="glyphicon glyphicon-arrow-left"></span>
    </a>
    <?php else:?>
      <?php include('portifolio_list_ajax_view.php');?>
    <?php endif;?>
    </div><!-- pg ajax-->
  </div>
</div>
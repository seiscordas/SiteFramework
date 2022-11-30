<!-- Modal -->
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" rel="tooltip" title="Concluir" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span></button>
      <h4 class="modal-title" id="myModalLabel">Alterar Evento.</h4>
    </div>
    <div class="modal-body">
    <?php //var_dump($row);die;?>
	  <?php echo form_open_multipart('evento/up/'.$row->idevento,'class="form-horizontal form-ajax-validate" role="form" id="form-event"');?>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Nome do Evento:</span></label>
          <div class="col-lg-5">
            <input type="text" name="nomeEvent" class="form-control input-compare" id="nomeEvent" value="<?php echo $row->nomeEvent;?>" validation="validate[required]" data-table="evento" data-val="<?php echo $row->nomeEvent;?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 control-label"><span>Imagem do Evento:</span></label>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <a href="<?php echo base_url('imagem/lista');?>" class="btn btn-primary img-modal inf-tooltip ajax-modal" data-placement="bottom" data-dest-img="event" data-toggle="img-modal" data-target="#img-modal" title="Selecionar Imagem"><span class="glyphicon glyphicon-picture"></span></a>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <img src="<?php echo img_size('uploads',$row->nomeImg,100,NULL,'apainel/');?>" class="img-thumbnail" id="img-view-event" title="">
            <input type="hidden" name="fk_idimg" id="fk_idimg-event" value="<?php echo $row->fk_idimg;?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Descrição do Evento:</span></label>
          <div class="col-lg-5">
            <textarea type="text" name="descEvent" class="form-control" rows="7" validation="validate[required]"><?php echo $row->descEvent;?></textarea>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label">Status:</label>
          <div class="col-lg-5">
            <label class="radio-inline">
              <input type="radio" name="fk_idstatus" value="A" validation="validate[required]" <?php if($row->fk_idstatus == 'A')echo 'checked';?>> Ativo
            </label>
            
            <label class="radio-inline">
              <input type="radio" name="fk_idstatus" value="I" validation="validate[required]" <?php if($row->fk_idstatus == 'I')echo 'checked';?>> Inativo
            </label>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label">Destaque:</label>
          <div class="col-lg-5">
            <label class="radio-inline">
              <input type="radio" name="destaque" value="S" validation="validate[required]" <?php if($row->destaque == 'S')echo 'checked';?>> Sim
            </label>
            
            <label class="radio-inline">
              <input type="radio" name="destaque" value="N" validation="validate[required]" <?php if($row->destaque == 'N')echo 'checked';?>> Não
            </label>
          </div>
        </div>
        
        <!-- hidden -->
        <input type="hidden" name="fk_iduser" value="<?php echo $this->usuario['iduser'];?>">
        <input type="hidden" name="idevento" value="<?php echo $row->idevento;?>">
        <!-- hidden -->
        
        <input type="submit" value="Gravar" class="btn btn-success btn-validar">
      </form>
    </div>
    <div class="modal-footer">
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap-filestyle.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.form.min.js");?>"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	load_plugins();
});
</script>
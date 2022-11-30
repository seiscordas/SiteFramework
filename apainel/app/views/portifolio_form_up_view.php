<!-- Modal -->
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" rel="tooltip" title="Concluir" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span></button>
      <h4 class="modal-title" id="myModalLabel">Alterar Portifolio.</h4>
    </div>
    <div class="modal-body">
    <?php //var_dump($row);die;?>
	  <?php echo form_open_multipart('portifolio/up/'.$row->idportifolio,'class="form-horizontal form-ajax-validate" role="form" id="form-event"');?>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Nome do Portifolio:</span></label>
          <div class="col-lg-5">
            <input type="text" name="nomePort" class="form-control input-compare" id="nomePort" value="<?php echo $row->nomePort;?>" validation="validate[required]" data-table="portifolio" data-val="<?php echo $row->nomePort;?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 control-label"><span>Imagem do Portifolio:</span></label>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <a href="<?php echo base_url('imagem/lista');?>" class="btn btn-primary img-modal inf-tooltip ajax-modal" data-placement="bottom" data-dest-img="port" data-toggle="img-modal" data-target="#img-modal" title="Selecionar Imagem"><span class="glyphicon glyphicon-picture"></span></a>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <img src="<?php echo img_size('uploads',$row->nomeImg,100,NULL,'apainel/');?>" class="img-thumbnail" id="img-view-port" title="">
            <input type="hidden" name="fk_idimg" id="fk_idimg-port" value="<?php echo $row->fk_idimg;?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Descrição do Portifolio:</span></label>
          <div class="col-lg-5">
            <textarea type="text" name="descPort" class="form-control" rows="7"><?php echo $row->descPort;?></textarea>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Link:</span></label>
          <div class="col-lg-5">
            <input type="text" name="linkPort" class="form-control" value="<?php echo $row->linkPort;?>">
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
        <input type="hidden" name="idportifolio" value="<?php echo $row->idportifolio;?>">
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
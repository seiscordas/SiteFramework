<!-- Modal -->
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" rel="tooltip" title="Concluir" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span></button>
      <h4 class="modal-title" id="myModalLabel">Novo Portifolio.</h4>
    </div>
    <div class="modal-body">
	  <?php echo form_open_multipart('portifolio/add/','class="form-horizontal form-ajax-validate" role="form" id="form-event" data-dest-img="port"');?>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Nome:</span></label>
          <div class="col-lg-5">
            <input type="text" name="nomePort" class="form-control input-compare" id="nomePort" data-table="portifolio" placeholder="Nome do Portifolio" validation="validate[required]">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 control-label"><span>Imagem do Portifolio:</span></label>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <a href="<?php echo base_url('imagem/lista');?>" class="btn btn-primary img-modal inf-tooltip ajax-modal" data-placement="bottom" data-dest-img="port" data-toggle="img-modal" data-target="#img-modal" title="Selecionar Imagem"><span class="glyphicon glyphicon-picture"></span></a>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <img src="" class="img-thumbnail" id="img-view-port" title="">
            <input type="hidden" name="fk_idimg" id="fk_idimg-port" value="<?php echo $row->fk_idimg;?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Descrição do Portifolio:</span></label>
          <div class="col-lg-5">
            <textarea type="text" name="descPort" class="form-control" rows="7"></textarea>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Link:</span></label>
          <div class="col-lg-5">
            <input type="text" name="linkPort" class="form-control" placeholder="Link do Site">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label">Status:</label>
          <div class="col-lg-5">
            <label class="radio-inline">
              <input type="radio" name="fk_idstatus" value="A" validation="validate[required]" checked> Ativo
            </label>
            
            <label class="radio-inline">
              <input type="radio" name="fk_idstatus" value="I" validation="validate[required]"> Inativo
            </label>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label">Destaque:</label>
          <div class="col-lg-5">
            <label class="radio-inline">
              <input type="radio" name="destaque" value="S" validation="validate[required]"> Sim
            </label>
            
            <label class="radio-inline">
              <input type="radio" name="destaque" value="N" validation="validate[required]" checked> Não
            </label>
          </div>
        </div>
        
        <!-- hidden -->
        <input type="hidden" name="fk_iduser" value="<?php echo $this->usuario['iduser'];?>">
        <!-- hidden -->
        
        <input type="submit" value="Gravar" class="btn btn-success btn-validar">
      </form>
    </div>
    <div class="modal-footer">
      <div class="msg-txt"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(e) {
	load_plugins();
	// Valida imagem
	$(".btn-validar").click(function(){
		var fk_idimg = $("#fk_idimg-port").val();
		if(!fk_idimg)
		{
			alert("Seleicione uma imagem!");
			return false;
		}
	});
});
</script>
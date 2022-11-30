<!-- Modal -->
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" rel="tooltip" title="Concluir" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span></button>
      <h4 class="modal-title" id="myModalLabel">Novo Evento.</h4>
    </div>
    <div class="modal-body">
	  <?php echo form_open_multipart('evento/add/','class="form-horizontal" role="form" id="form-event" data-dest-img="event"');?>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Nome do Evento:</span></label>
          <div class="col-lg-5">
            <input type="text" name="nomeEvent" class="form-control input-compare" id="nomeEvent" data-table="evento" placeholder="Nome do Evento" validation="validate[required]">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 control-label"><span>Imagem do Evento:</span></label>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <a href="<?php echo base_url('imagem/lista');?>" class="btn btn-primary img-modal inf-tooltip ajax-modal" data-placement="bottom" data-dest-img="event" data-toggle="img-modal" data-target="#img-modal" title="Selecionar Imagem"><span class="glyphicon glyphicon-picture"></span></a>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <img src="" class="img-thumbnail" id="img-view-event" title="">
            <input type="hidden" name="fk_idimg" id="fk_idimg-event" value="<?php echo $row->fk_idimg;?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Descrição do Evento:</span></label>
          <div class="col-lg-5">
            <textarea type="text" name="descEvent" class="form-control" rows="7" validation="validate[required]"></textarea>
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
	// Tootips
	$('.inf-tooltip').tooltip({'placement': 'right', 'z-index': '3000'});
	// Valida imagem
	$(".btn-validar").click(function(){
		var fk_idimg = $("#fk_idimg-event").val();
		if(!fk_idimg)
		{
			alert("Seleicione uma imagem!");
			return false;
		}
	});
	// Validation Engine
	$("#form-event").validationEngine({
		showOneMessage : true,
		promptPosition : "top",
		binded: false,
		onValidationComplete: function(form, status){
			if(status === true)
			{
				var pag = $("#form-event").attr("action");
				var dados = $("#form-event").serialize();
				$.ajax({
				type: "POST",
				url: pag,
				data: dados,
				dataType: "JSON",
				success: function(retorno){
					if(retorno.loadList == '1'){
						navAjax(current_url, null, ".pg-ajax");
					}
					if(retorno.resetForm == '1'){
						var img = $("#form-event").attr("data-dest-img");
						$("#form-event")[0].reset();
						$("#img-view-" + img).attr('src', '');
						$("#fk_idimg-" + img).val('');
					}
					if(retorno.msgBool == '1'){
						$(".msg-txt").append("<h3 class='text-success msg pull-left'>" + retorno.msgTxt + "</h3>");
						$('.msg').fadeOut(8000);
					}
					if(retorno.fechaModal == '1'){
						$('.modal').modal('hide');
					}
				}
			});
				return false;				
			}
		}
	});
});
</script>
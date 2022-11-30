<!-- Modal -->
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" rel="tooltip" title="Concluir" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span></button>
      <h4 class="modal-title" id="myModalLabel">Nova Categoria.</h4>
    </div>
      <div class="modal-body">
        <?php echo form_open_multipart('categoria/add/?loadlist=' . $loadList,'class="form-horizontal form-validate-cat" role="form" id="form-cat"');?>
     
          <div class="form-group">
            <label class="col-xs-3 control-label"><span>Nome da Categoria:</span></label>
            <div class="col-lg-5">
              <input type="text" name="nomeCat" class="form-control input-compare" id="nomeCat" data-table="categoria" placeholder="Nome do Categoria" validation="validate[required]">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 control-label"><span>Imagem da Categoria:</span></label>
            <div class="col-lg-2 col-md-2 col-sm-2">
              <a href="<?php echo base_url('imagem/lista');?>" class="btn btn-primary inf-tooltip ajax-modal" data-dest-img="cat" data-placement="bottom" data-toggle="img-modal" title="Selecionar Imagem"><span class="glyphicon glyphicon-picture"></span></a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
              <img src="" class="img-thumbnail" id="img-view-cat" title="">
              <input type="hidden" name="fk_idimg" id="fk_idimg-cat" value="<?php echo $row->fk_idimg;?>">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-xs-3 control-label"><span>Descrição da Categoria:</span></label>
            <div class="col-xs-5">
              <textarea type="text" name="descCat" class="form-control" rows="7" validation="validate[required]"></textarea>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-xs-3 control-label">Status:</label>
            
            <label class="radio-inline">
              <input type="radio" name="fk_idstatus" value="A" validation="validate[required]" checked> Ativo:
            </label>
            
            <label class="radio-inline">
              <input type="radio" name="fk_idstatus" value="I" validation="validate[required]"> Inativo:
            </label>
          </div>
          
          <!-- hidden -->
          <input type="hidden" name="fk_users_id" value="<?php echo $this->usuario['iduser'];?>">
          <!-- hidden -->
          
          <input type="submit" value="Gravar" class="btn btn-success btn-form-ajax">
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
		var fk_idimg = $("#fk_idimg-cat").val();
		if(!fk_idimg)
		{
			alert("Seleicione uma imagem!");
			return false;
		}
	});
	// Validation Engine
	$(".form-validate-cat").validationEngine({
		showOneMessage : true,
		promptPosition : "top",
		binded: false,
		onValidationComplete: function(form, status){
			if(status === true)
			{
				var pag = $(".form-validate-cat").attr("action");
				var dados = $(".form-validate-cat").serialize();
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
							$("#form-cat")[0].reset();
							$("#img-view-cat").attr('src', '');
							$("#fk_idimg-cat").val('');
						}
						if(retorno.msgBool == '1'){
							$("#add-cat .msg-txt").append("<h3 class='text-success msg pull-left'>" + retorno.msgTxt + "</h3>");
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
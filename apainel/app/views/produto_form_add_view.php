<!-- Modal -->
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" rel="tooltip" title="Concluir" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span></button>
      <h4 class="modal-title" id="myModalLabel">Nova Produto.</h4>
    </div>
    <div class="modal-body">
	  <?php echo form_open_multipart('produto/add/','class="form-horizontal form-ajax-validate" role="form" id="form-prod" data-dest-img="prod"');?>
          
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Categoria:</span></label>
          <div class="col-lg-5">
            <div class="input-group">
              <input type="text" name="categoria" class="form-control auto-comp-cat" id="categoria">
              <span class="input-group-btn">
                <a href="<?php echo base_url('categoria/form_add/?loadlist=0');?>" class="btn btn-default inf-tooltip ajax-modal" data-toggle="add-cat" data-target="#add-cat" title="Nova Categoria">
                  <span class="glyphicon glyphicon-plus"></span>
                </a>
              </span>
            </div><!-- /input-group -->
          </div>
          <input type="hidden" name="fk_idcategoria" id="fk_idcategoria">
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Nome do Produto:</span></label>
          <div class="col-lg-5">
            <input type="text" name="nomeProd" class="form-control input-compare" id="nomeProd" data-table="produto" placeholder="Nome do Produto" validation="validate[required]">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 control-label"><span>Imagem do Produto:</span></label>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <a href="<?php echo base_url('imagem/lista');?>" class="btn btn-primary img-modal inf-tooltip ajax-modal" data-placement="bottom" data-dest-img="prod" data-toggle="img-modal" data-target="#img-modal" title="Selecionar Imagem"><span class="glyphicon glyphicon-picture"></span></a>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <img src="" class="img-thumbnail" id="img-view-prod" title="">
            <input type="hidden" name="fk_idimg" id="fk_idimg-prod" value="<?php echo $row->fk_idimg;?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Descrição do Produto:</span></label>
          <div class="col-lg-5">
            <textarea type="text" name="descProd" class="form-control" rows="7" validation="validate[required]"></textarea>
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
	//Auto Complete de Categoria #######################
	$(function(){
		$( ".auto-comp-cat" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					type: "POST",
					url: '<?php echo base_url('categoria/auto_complete');?>',
					dataType: "json",
					data: {
					termo: request.term,
					},
					success: function( data ) {
					response( $.map(data,function(item){
							return{								
								label: item.nomeCat,
								value: item.nome,
								id: item.idcategoria
							}
						}))
					},
				});
			},
			minLength: 0,
			open: function () {
				$(this).autocomplete('widget').zIndex(20000);
			},
			select: function( event, ui ) {
				$( "#fk_idcategoria" ).val( ui.item.id );
			}
		});
	});
	// Limpa input #fk_idcategoria quando digitar no campo #categoria
	$("#categoria").keyup(function(){
		$("#fk_idcategoria").val('');
	});
	// Categoria e imagem
	$(".btn-validar").click(function(){
		var fk_idcategoria = $("#fk_idcategoria").val();
		var fk_idimg       = $("#fk_idimg-prod").val();
		if(!fk_idcategoria)
		{
			var categoria = $("#categoria").val();
			alert('"' + categoria + '" Categoria Invalida!');
			$("#categoria").focus();
			return false;
		}
		else if(!fk_idimg)
		{
			alert("Seleicione uma imagem!");
			return false;
		}
	});
});
</script>
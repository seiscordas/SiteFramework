<!-- Modal -->
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" rel="tooltip" title="Concluir" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span></button>
      <h4 class="modal-title" id="myModalLabel">Alterar Produto.</h4>
    </div>
    <div class="modal-body">
    <?php //var_dump($row);die;?>
	  <?php echo form_open_multipart('produto/up/'.$row->idproduto,'class="form-horizontal form-ajax-validate" role="form" id="form-prod"');?>
          
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Categoria:</span></label>
          <div class="col-lg-5">
            <div class="input-group">
              <input type="text" name="categoria" class="form-control auto-comp-cat" id="categoria" value="<?php echo $row->nomeCat;?>">
              <span class="input-group-btn">
                <a href="<?php echo base_url('categoria/form_add/?loadlist=0');?>" class="btn btn-default inf-tooltip ajax-modal" data-toggle="add-cat" data-target="#add-cat" title="Nova Categoria">
                  <span class="glyphicon glyphicon-plus"></span>
                </a>
              </span>
            </div><!-- /input-group -->
          </div>
          <input type="hidden" name="fk_idcategoria" id="fk_idcategoria" value="<?php echo $row->fk_idcategoria;?>">
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Nome do Produto:</span></label>
          <div class="col-lg-5">
            <input type="text" name="nomeProd" class="form-control input-compare" id="nomeProd" value="<?php echo $row->nomeProd;?>" validation="validate[required]" data-table="produto" data-val="<?php echo $row->nomeProd;?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 control-label"><span>Imagem do Produto:</span></label>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <a href="<?php echo base_url('imagem/lista');?>" class="btn btn-primary img-modal inf-tooltip ajax-modal" data-placement="bottom" data-dest-img="prod" data-toggle="img-modal" data-target="#img-modal" title="Selecionar Imagem"><span class="glyphicon glyphicon-picture"></span></a>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <img src="<?php echo img_size('uploads',$row->nomeImg,100,NULL,'apainel/');?>" class="img-thumbnail" id="img-view-prod" title="">
            <input type="hidden" name="fk_idimg" id="fk_idimg-prod" value="<?php echo $row->fk_idimg;?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Descrição do Produto:</span></label>
          <div class="col-lg-5">
            <textarea type="text" name="descProd" class="form-control" rows="7" validation="validate[required]"><?php echo $row->descProd;?></textarea>
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
        <input type="hidden" name="idproduto" value="<?php echo $row->idproduto;?>">
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
	//Auto Complete de Categoria #######################
	$(function(){
		$( ".auto-comp-cat" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					type: "POST",
					url: path+"categoria/auto_complete",
					dataType: "json",
					data: {
					termo: request.term,
					fk_idcaixa_tipo: $(".fk_idcaixa_tipo:checked").val()
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
	// Categoria
	$(".btn-validar").click(function(){
		var fk_idcategoria = $("#fk_idcategoria").val();
		if(!fk_idcategoria)
		{
			var categoria = $("#categoria").val();
			alert('"' + categoria + '" Categoria Invalida!');
			$("#categoria").focus();
			return false;
		}
	});
});
</script>
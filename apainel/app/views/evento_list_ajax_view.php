<table class="tablesorter table table-striped">
  <thead>
    <tr>
      <th>Imagem</th>
      <th>Depoimento</th>
      <th>Galeria</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($dados as $row):?>
    <tr id="<?php echo $row->idevento;?>">
      <td><img src="<?php echo img_size('uploads',$row->nomeImg,80,NULL,'apainel/');?>" title=""></td>
      <td><?php echo $row->nomeEvent;?></td>
      <td>
        <button title="Adicionar ou trocar galeria de imagens" class="btn btn-default inf-tooltip-lista" data-toggle="modal" data-target="#add-gal">
          <span class="glyphicon glyphicon-edit"></span>
        </button>
      </td>
      <td>
        <a href="<?php echo base_url("evento/form_up/".$row->idevento);?>" title="Visualizar / Editar" class="btn btn-default inf-tooltip-lista ajax-modal" data-toggle="up-event" data-target="#up-event">
            <span class="glyphicon glyphicon-eye-open"></span> / 
            <span class="glyphicon glyphicon-edit"></span>
        </a>
        <?php $novoStatus = ($row->fk_idstatus == 'A') ? 'I' : 'A';?>
        <?php if($row->fk_idstatus == 'A'):?>
        <a href="<?php echo base_url("evento/ativa_desativa/".$row->idevento.'/'.$novoStatus);?>" title="Desativar" class="status-conf btn btn-info inf-tooltip-lista">
          <span class="glyphicon glyphicon-ban-circle"></span>
        </a>
        <?php elseif($row->fk_idstatus == 'I'):?>
        <a href="<?php echo base_url("evento/ativa_desativa/".$row->idevento.'/'.$novoStatus);?>" title="Ativar" class="btn btn-info del-ajax inf-tooltip-lista">
          <span class="glyphicon glyphicon-ok-circle"></span>
        </a>
        <?php endif;?>
        <!-- EXCLUIR -->
        <a href="<?php echo base_url("evento/del/".$row->idevento);?>" title="Excluir" class="confirma btn btn-danger inf-tooltip-lista">
            <span class="glyphicon glyphicon-trash"></span>
        </a>
      </td>
    </tr>
  <?php endforeach;?>
  </tbody>
</table>
<div class="text-center">
  <ul class="pagination pagination-sm">
    <?php echo $paginacao;?>
  </ul>
</div>

<!-- Modal -->
<div class="modal fade not-ren" id="add-gal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" rel="tooltip" title="Concluir" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar ou trocar galeria de imagens.</h4>
      </div>
        <div class="modal-body">
          <form action="<?php echo base_url('evento/add_up_gal');?>" class="form-ajax-validate" role="form" method="post">
            <!--hidden-->
            <input type="hidden" name="idevento" value="<?php echo $row->idevento;?>">
            <input type="hidden" name="fk_idgaleria" id="fk_idgaleria" value="<?php echo $row->fk_idgaleria;?>">
            <!--hidden-->
            <div class="form-group">
              <div class="input-group">
                <input name="termo" type="text" class="form-control auto-comp-gal" id="galeria" placeholder="Adicionar Galeria" value="<?php echo $row->nomeGal;?>">
                <span class="input-group-btn">
                  <button class="btn btn-default btn-validar" type="button">Gravar</button>
                </span>
              </div><!-- /input-group -->  
            </div>
          </form>
        </div>
    </div>
  </div>
</div>

<script>
// Tootips
$('.inf-tooltip-lista').tooltip({'placement': 'top', 'z-index': '3000'});
$(document).ready(function(e) {
	//Auto Complete de galeria #######################
	$(function(){
		$( ".auto-comp-gal" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					type: "POST",
					url: path+"galeria/auto_complete",
					dataType: "json",
					data: {
					termo: request.term,
					fk_idcaixa_tipo: $(".fk_idcaixa_tipo:checked").val()
					},
					success: function( data ) {
					response( $.map(data,function(item){
							return{								
								label: item.nomeGal,
								value: item.nomeGal,
								id: item.idgaleria
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
				$( "#fk_idgaleria" ).val( ui.item.id );
			}
		});
	});
	// Limpa input #fk_idgaleria quando digitar no campo #galeria
	$("#galeria").keyup(function(){
		$("#fk_idgaleria").val('');
	});
	// galeria
	$(".btn-validar").click(function(){
		var fk_idgaleria = $("#fk_idgaleria").val();
		if(!fk_idgaleria)
		{
			var galeria = $("#galeria").val();
			alert('"' + galeria + '" galeria Invalida!\nDigite um nome e clique sobre o item correspondente.');
			$("#galeria").focus();
			return false;
		}
		else
		{
			var pag = $(".form-ajax-validate").attr("action");
			var dados = $(".form-ajax-validate").serialize();
			enviaFormAjax(pag, dados);
			return false;	
		}
	});
});
</script>
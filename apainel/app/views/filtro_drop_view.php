<script type="text/javascript">
//Acordion
$(document).ready(function(){
	$(function() {
		$(".h-overflow").css({
			"position":"absolute",
			"overflow":"hidden",
			"z-index":"1000"
			});
		$( ".accordion" ).accordion({
			heightStyle: "content",
			collapsible: true,
			active: false
		});
		$(".accord-collapse").click(function(){
			var procurarDe = $('input[name="procurarDe"]').val();
			var procurarAte = $('input[name="procurarAte"]').val();
			if(procurarDe != '' && procurarAte == '')
			{
				$('input[name="procurarAte"]').focus();
				return false;
			}
			else if(procurarAte != '' && procurarDe == '')
			{
				$('input[name="procurarDe"]').focus();
				return false;
			}
			else
			{
				$( ".accordion" ).accordion({active: false});
			}
		});
		$(".accordion .close").click(function(){
			$( ".accordion" ).accordion({active: false});
		});
	});
});
</script>
<div class="accordion col-sm-4 col-md-4 col-lg-4">
  <h3>Filtro de Busca</h3>
  <div class="form-group h-overflow">
    <?php echo $addFiltro;?>
    <input name="dia" type="text" class="data form-control" placeholder="Por Data Específica">
    <div class="row">
      <div class="col-md-6">
        <select name="mes" class="form-control">
          <option value="">Por Mês</option>
          <?php for($i=1; $i<=12; $i++):?>
          <?php $opt = ($i <= 9)? 0 .$i : $i;?> 
          <option value="<?php echo $opt;?>"><?php echo $opt;?></option>
          <?php endfor;?>
        </select>
      </div>
      <div class="col-md-6"><?php echo form_dropdown('ano',$dadosAnos,'','class="form-control"');?></div>
    </div>
    <div class="row">
      <div class="col-md-6"><input name="procurarDe" type="text" class="data form-control" placeholder="Período de"></div>
      <div class="col-md-6"><input name="procurarAte" type="text" class="data form-control" placeholder="Até"></div>
    </div>
    <button type="submit" class="btn btn-default accord-collapse">Procurar</button>
    <span class="close" title="Fechar">X</span>
  </div>
</div>
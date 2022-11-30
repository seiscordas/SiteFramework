<table class="tablesorter table table-striped">
  <thead>
    <tr>
      <th>Imagem</th>
      <th>Depoimento</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($dados as $row):?>
    <tr id="<?php echo $row->iddepoimento;?>">
      <td><img src="<?php echo img_size('uploads',$row->nomeImg,80,NULL,'apainel/');?>" title=""></td>
      <td><?php echo $row->nomeDep;?></td>
      <td>
        <a href="<?php echo base_url("depoimento/form_up/".$row->iddepoimento);?>" title="Visualizar / Editar" class="btn btn-default inf-tooltip-lista ajax-modal" data-toggle="up-event" data-target="#up-event">
            <span class="glyphicon glyphicon-eye-open"></span> / 
            <span class="glyphicon glyphicon-edit"></span>
        </a>
        <?php $novoStatus = ($row->fk_idstatus == 'A') ? 'I' : 'A';?>
        <?php if($row->fk_idstatus == 'A'):?>
        <a href="<?php echo base_url("depoimento/ativa_desativa/".$row->iddepoimento.'/'.$novoStatus);?>" title="Desativar" class="status-conf btn btn-info inf-tooltip-lista">
          <span class="glyphicon glyphicon-ban-circle"></span>
        </a>
        <?php elseif($row->fk_idstatus == 'I'):?>
        <a href="<?php echo base_url("depoimento/ativa_desativa/".$row->iddepoimento.'/'.$novoStatus);?>" title="Ativar" class="btn btn-info del-ajax inf-tooltip-lista">
          <span class="glyphicon glyphicon-ok-circle"></span>
        </a>
        <?php endif;?>
        <!-- EXCLUIR -->
        <a href="<?php echo base_url("depoimento/del/".$row->iddepoimento);?>" title="Excluir" class="confirma btn btn-danger inf-tooltip-lista">
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

<script>
// Tootips
$('.inf-tooltip-lista').tooltip({'placement': 'top', 'z-index': '3000'});
</script>
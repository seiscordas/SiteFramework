<table class="tablesorter table table-striped">
  <thead>
    <tr>
      <th>Imagem</th>
      <th>Categoria</th>
      <th>Desc.</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($dados as $row):?>
    <tr id="<?php echo $row->idcategoria;?>">
      <td><img src="<?php echo img_size('uploads',$row->nomeImg,80,NULL,'apainel/');?>" class="img-thumbnail" title=""></td>
      <td><?php echo $row->nomeCat;?></td>
      <td><?php echo $row->descCat;?></td>
      <td>
        <a href="<?php echo base_url("categoria/form_up/".$row->idcategoria.'/'.$status);?>" title="Visualizar / Editar" class="btn btn-default inf-tooltip-lista ajax-modal" data-toggle="up-cat" data-target="#up-cat">
            <span class="glyphicon glyphicon-eye-open"></span> / 
            <span class="glyphicon glyphicon-edit"></span>
        </a>
        <?php $novoStatus = ($row->fk_idstatus == 'A') ? 'I' : 'A';?>
        <?php if($row->fk_idstatus == 'A'):?>
        <a href="<?php echo base_url("categoria/ativa_desativa/".$row->idcategoria.'/'.$novoStatus);?>" title="Desativar" class="status-conf btn btn-info inf-tooltip-lista">
          <span class="glyphicon glyphicon-ban-circle"></span>
        </a>
        <?php elseif($row->fk_idstatus == 'I'):?>
        <a href="<?php echo base_url("categoria/ativa_desativa/".$row->idcategoria.'/'.$novoStatus);?>" title="Ativar" class="btn btn-info del-ajax inf-tooltip-lista">
          <span class="glyphicon glyphicon-ok-circle"></span>
        </a>
        <?php endif;?>
        <!-- EXCLUIR -->
        <a href="<?php echo base_url("categoria/del/".$row->idcategoria);?>" title="Excluir" class="confirma btn btn-danger inf-tooltip-lista">
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
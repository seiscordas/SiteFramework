<table class="tablesorter table table-striped">
  <thead>
    <tr>
      <th>Imagem</th>
      <th>Produto</th>
      <th>Categoria</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($dados as $row):?>
    <tr id="<?php echo $row->idproduto;?>">
      <td><img src="<?php echo img_size('uploads',$row->nomeImg,80,NULL,'apainel/');?>" title=""></td>
      <td><?php echo $row->nomeProd;?></td>
      <td>
        <a href="<?php echo base_url("categoria/form_up/".$row->idcategoria);?>" title="Visualizar / Editar" class="btn btn-default inf-tooltip-lista ajax-modal" data-toggle="up-cat" data-target="#up-cat">
            <?php echo $row->nomeCat;?> <span class="glyphicon glyphicon-edit"></span>
        </a></td>
      <td>
        <a href="<?php echo base_url("produto/form_up/".$row->idproduto);?>" title="Visualizar / Editar" class="btn btn-default inf-tooltip-lista ajax-modal" data-toggle="up-prod" data-target="#up-prod">
            <span class="glyphicon glyphicon-eye-open"></span> / 
            <span class="glyphicon glyphicon-edit"></span>
        </a>
        <?php $novoStatus = ($row->fk_idstatus == 'A') ? 'I' : 'A';?>
        <?php if($row->fk_idstatus == 'A'):?>
        <a href="<?php echo base_url("produto/ativa_desativa/".$row->idproduto.'/'.$novoStatus);?>" title="Desativar" class="status-conf btn btn-info inf-tooltip-lista">
          <span class="glyphicon glyphicon-ban-circle"></span>
        </a>
        <?php elseif($row->fk_idstatus == 'I'):?>
        <a href="<?php echo base_url("produto/ativa_desativa/".$row->idproduto.'/'.$novoStatus);?>" title="Ativar" class="btn btn-info del-ajax inf-tooltip-lista">
          <span class="glyphicon glyphicon-ok-circle"></span>
        </a>
        <?php endif;?>
        <!-- EXCLUIR -->
        <a href="<?php echo base_url("produto/del/".$row->idproduto);?>" title="Excluir" class="confirma btn btn-danger inf-tooltip-lista">
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
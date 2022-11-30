<div class="pg-ajax">
  <table class="tablesorter table table-striped">
    <thead>
      <tr>
        <th>Código</th>
        <th>Usuário</th>
        <th>Tp. Usuário</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($dados as $row):?>
      <tr id="<?php echo $row->id;?>">
        <td><?php echo $row->id;?></td>
        <td><?php echo $row->nomeUser;?></td>
        <td><?php echo $row->perfil;?></td>
        <td>
          <a href="<?php echo base_url("usuario/form_up/".$row->id.'/'.$curStatus);?>" title="Visualizar / Editar" class="btn btn-default">
              <span class="glyphicon glyphicon-eye-open"></span> / 
              <span class="glyphicon glyphicon-edit"></span>
          </a>
        </td>
        <td>
          <?php $novoStatus = ($row->fk_idstatus == 'A') ? 'I' : 'A';?>
          <?php if($row->fk_idstatus == 'A'):?>
          <a href="<?php echo base_url("usuario/ativa_desativa/".$row->id.'/'.$novoStatus);?>" title="Desativar" class="status-conf btn btn-info">
            <span class="glyphicon glyphicon-ban-circle"></span>
          </a>
          <?php elseif($row->fk_idstatus == 'I'):?>
          <a href="<?php echo base_url("usuario/ativa_desativa/".$row->id.'/'.$novoStatus);?>" title="Ativar" class="btn btn-info del-ajax">
            <span class="glyphicon glyphicon-ok-circle"></span>
          </a>
          <?php endif;?>
          <!-- EXCLUIR -->
              <a href="<?php echo base_url("usuario/del/".$row->id);?>" title="Excluir" class="confirma btn btn-danger inf-tooltip">
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
</div><!-- pg ajax-->
<div class="pull-left">
  <a href="<?php echo base_url('home');?>" class="btn btn-default" title="Cancelar">
    <span class="glyphicon glyphicon-arrow-left"></span>
  </a>
  <a href="<?php echo base_url('usuario/form_add/'.$curStatus);?>" class="btn btn-default" title="Novo Usuario">
    <span class="glyphicon glyphicon-plus"></span>
  </a>
  <a href="<?php echo base_url('usuario/lista/'.$goStatus);?>" class="btn btn-default" title="Listar <?php echo ($curStatus == 'A') ? 'Inativos' : 'Ativos';?>">
    <span class="glyphicon glyphicon-list"></span> <?php echo ($curStatus == 'A') ? 'Inativos' : 'Ativos';?>
  </a>
</div>
<div class="clearfix"></div>
<div class="panel panel-primary">
  <div class="panel-heading">
    Lista de Usuário <?php echo ($curStatus == 'A') ? 'Ativo' : 'Inativo';?>
  </div>
  <div class="panel-body">
    <?php if(!$dados):?>
    Não há dados!
    <a href="<?php echo base_url('admin');?>" class="btn btn-default inf-tooltip" title="Voltar">
      <span class="glyphicon glyphicon-arrow-left"></span>
    </a>
    <?php else:?>
    <div class="pg-ajax">
      <table class="tablesorter table table-striped">
        <thead>
          <tr>
            <th>Código</th>
            <th>Usuário</th>
            <th>Tp. Usuário</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($dados as $row):?>
          <tr id="<?php echo $row->iduser;?>">
            <td><?php echo $row->iduser;?></td>
            <td><?php echo $row->nome;?></td>
            <td><?php echo $row->perfil;?></td>
            <td>
              <a href="<?php echo base_url("usuario/form_up/".$row->iduser.'/'.$curStatus);?>" title="Visualizar / Editar" class="btn btn-default">
                  <span class="glyphicon glyphicon-eye-open"></span> / 
                  <span class="glyphicon glyphicon-edit"></span>
              </a>
              <?php if($row->username != 'ADMIN'):?>
              <?php $novoStatus = ($row->fk_idstatus == 'A') ? 'I' : 'A';?>
              <?php if($row->fk_idstatus == 'A'):?>
              <a href="<?php echo base_url("usuario/ativa_desativa/".$row->iduser.'/'.$novoStatus);?>" title="Desativar" class="status-conf btn btn-info">
                <span class="glyphicon glyphicon-ban-circle"></span>
              </a>
              <?php elseif($row->fk_idstatus == 'I'):?>
              <a href="<?php echo base_url("usuario/ativa_desativa/".$row->iduser.'/'.$novoStatus);?>" title="Ativar" class="btn btn-info del-ajax">
                <span class="glyphicon glyphicon-ok-circle"></span>
              </a>
              <?php endif;?>
              <!-- EXCLUIR -->
              <a href="<?php echo base_url("usuario/del/".$row->iduser);?>" title="Excluir" class="confirma btn btn-danger inf-tooltip">
                  <span class="glyphicon glyphicon-trash"></span>
              </a>
              <?php endif;?>
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
    <?php endif;?>
  </div>
</div>
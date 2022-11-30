<a href="<?php echo base_url('usuario/lista/'.$status);?>" class="btn btn-default inf-tooltip" title="Voltar Para Lista de Cliente">
  <span class="glyphicon glyphicon-arrow-left"></span> 
</a>
<h2>Cadastrar Usuário</h2>
<?php echo form_open('usuario/up/'.$status,'class="form-horizontal validar" role="form"');?>
  <!-- hidden -->
  <input type="hidden" name="iduser" value="<?php echo $row->iduser;?>">
  <!-- hidden -->
  <div class="form-group">
    <label class="col-lg-2 control-label"><span>Perfil de usuário:</span></label>
    <div class="col-lg-2">
      <select name="fk_idperfil"  class="perfil form-control" validation="validate[required]">
        <?php if($row->fk_idperfil == 1):?>
        <option value="1" <?php if($row->fk_idperfil == 1)echo "selected";?>>ADMINISTRADOR</option>
        <?php endif;?>
        <option value="2" <?php if($row->fk_idperfil == 2)echo "selected";?>>USUÁRIO</option>
      </select>
    </div>
  </div>
    
  <div class="form-group">
    <label class="col-lg-2 control-label"><span>Nome Pessoal:</span></label>
    <div class="col-lg-3">
      <input type="text" name="nome" class="form-control to-upper" id="nome" value="<?php echo $row->nome;?>" validation="validate[required]">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-lg-2 control-label"><span>E-mail:</span></label>
    <div class="col-lg-3">
      <input type="text" name="email" class="form-control to-upper input-compare" id="email" data-table="user" value="<?php echo $row->email;?>" validation="validate[required,custom[email]]">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-lg-2 control-label"><span>Nome de Usuário:</span></label>
    <div class="col-lg-2">
      <input type="text" class="alphanumeric form-control input-compare" value="<?php echo $row->username;?>" readonly>
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-lg-2 control-label"><span>Senha:</span></label>
    <div class="col-lg-2">
      <input type="password" name="password" class="form-control" id="senha" placeholder="Senha de Acesso">
    </div>
  </div>
  
  <div class="form-group conf_senha">
    <label class="col-lg-2 control-label"><span>Confirmar Senha:</span></label>
    <div class="col-lg-2">
      <input type="password" class="form-control" id="conf_senha" placeholder="Confirmar Senha de Acesso">
    </div>
  </div>
  <?php if($row->username != 'ADMIN'):?>
  <div class="form-group">
    <label class="col-lg-2 control-label">Status:</label>
    
    <label class="radio-inline">
      <input type="radio" name="fk_idstatus" value="A" <?php if($row->fk_idstatus == 'A')echo "checked";?>> Ativo:
    </label>
    
    <label class="radio-inline">
      <input type="radio" name="fk_idstatus" value="I" <?php if($row->fk_idstatus == 'I')echo "checked";?>> Inativo:
    </label>
  </div>
  <?php else:?>
    <input type="hidden" name="fk_idstatus" value="<?php echo $row->fk_idstatus;?>">
  <?php endif;?>
  
  <hr>
  <div class="form-group">
    <label class="col-lg-2 control-label"><span>Data de Cadastro:</span></label>
    <div class="col-lg-2">
      <input type="text" name="dtCadastro" class="form-control" value="<?php echo data($row->dtCadastro,'/');?>" readonly>
    </div>
  </div>
  
  <input type="submit" value="Gravar" class="btn btn-success senha dropSelect bottom_fly btn-input-compare">
</form>
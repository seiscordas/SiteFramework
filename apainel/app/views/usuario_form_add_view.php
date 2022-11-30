<a href="<?php echo base_url('usuario/lista/'.$status);?>" class="btn btn-default inf-tooltip" title="Voltar Para Lista de Cliente">
  <span class="glyphicon glyphicon-arrow-left"></span> 
</a>
<h2>Cadastrar Usuário</h2>
<?php echo form_open('usuario/add/'.$status,'class="form-horizontal validar" role="form"');?>
    
  <div class="form-group">
    <label class="col-lg-2 control-label"><span>Perfil de usuário:</span></label>
    <div class="col-lg-2">
      <select name="fk_idperfil"  class="perfil form-control" validation="validate[required]">
        <option value="">Selecione</option>
        <option value="1">ADMINISTRADOR</option>
        <option value="2" selected>USUÁRIO</option>
      </select>
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-lg-2 control-label"><span>Nome Pessoal:</span></label>
    <div class="col-lg-3">
      <input type="text" name="nome" class="form-control to-upper" id="nome" placeholder="Nome Pessoal" validation="validate[required]">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-lg-2 control-label"><span>E-mail:</span></label>
    <div class="col-lg-3">
      <input type="text" name="email" class="form-control to-upper input-compare" id="email" data-table="user" validation="validate[required,custom[email]]">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-lg-2 control-label"><span>Nome de Usuário:</span></label>
    <div class="col-lg-2">
      <input type="text" name="username" class="alphanumeric form-control input-compare to-upper" id="usuario" data-table="user" placeholder="Nome de Usuário" validation="validate[required]" autocomplete="off">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-lg-2 control-label"><span>Senha:</span></label>
    <div class="col-lg-2">
      <input type="password" name="password" class="form-control" id="senha" placeholder="Senha de Acesso" validation="validate[required]">
    </div>
  </div>
  
  <div class="form-group conf_senha">
    <label class="col-lg-2 control-label"><span>Confirmar Senha:</span></label>
    <div class="col-lg-2">
      <input type="password" class="form-control" id="conf_senha" placeholder="Confirmar Senha de Acesso" validation="validate[required]">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-lg-2 control-label">Status:</label>
    
    <label class="radio-inline">
      <input type="radio" name="fk_idstatus" value="A" validation="validate[required]" checked> Ativo:
    </label>
    
    <label class="radio-inline">
      <input type="radio" name="fk_idstatus" value="I" validation="validate[required]"> Inativo:
    </label>
  </div>
  
  <hr>
  
  <div class="form-group">
    <label class="col-lg-2 control-label"><span>Data de Cadastro:</span></label>
    <div class="col-lg-2">
      <input type="text" name="dtCadastro-dt" class="form-control" value="<?php echo date("d/m/Y");?>" readonly>
    </div>
  </div>
  
  <!--hidden-->
  <!--hidden-->
  
  <input type="submit" value="Gravar" class="btn btn-success senha dropSelect bottom_fly">
</form>
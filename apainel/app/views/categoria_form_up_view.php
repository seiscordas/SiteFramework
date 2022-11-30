<!-- Modal -->
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" rel="tooltip" title="Concluir" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span></button>
      <h4 class="modal-title" id="myModalLabel">Alterar Categoria.</h4>
    </div>
    <div class="modal-body modal-scroll">
	  <?php echo form_open_multipart('categoria/up/','class="form-horizontal form-ajax-validate" role="form" id="form-cat"');?>
   
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Nome da Categoria:</span></label>
          <div class="col-lg-5">
            <input type="text" name="nomeCat" class="form-control input-compare" id="nomeCat" data-table="categoria" data-val="<?php echo $row->nomeCat;?>" placeholder="Nome do Categoria" validation="validate[required]" value="<?php echo $row->nomeCat;?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 control-label"><span>Imagem da Categoria:</span></label>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <a href="<?php echo base_url('imagem/lista');?>" class="btn btn-primary inf-tooltip ajax-modal" data-dest-img="cat" data-placement="bottom" data-toggle="img-modal" title="Selecionar Imagem"><span class="glyphicon glyphicon-picture"></span></a>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <img src="<?php echo img_size('uploads', $row->nomeImg, 100, NULL, '/apainel');?>" class="img-thumbnail" id="img-view-cat" title="">
            <input type="hidden" name="fk_idimg" id="fk_idimg-cat" value="<?php echo $row->fk_idimg;?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label"><span>Descrição da Categoria:</span></label>
          <div class="col-xs-5">
            <textarea type="text" name="descCat" class="form-control" rows="7" validation="validate[required]"><?php echo $row->descCat;?></textarea>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-3 control-label">Status:</label>
          
          <label class="radio-inline">
            <input type="radio" name="fk_idstatus" value="A" validation="validate[required]" <?php if($row->fk_idstatus == "A") echo 'checked';?>> Ativo:
          </label>
          
          <label class="radio-inline">
            <input type="radio" name="fk_idstatus" value="I" validation="validate[required]" <?php if($row->fk_idstatus == "I") echo 'checked';?>> Inativo:
          </label>
        </div>
        
        <!-- hidden -->
        <input type="hidden" name="fk_users_id" value="<?php echo $this->usuario['iduser'];?>">
        <input type="hidden" name="idcategoria" value="<?php echo $row->idcategoria;?>">
        <!-- hidden -->
        
        <input type="submit" value="Gravar" class="btn btn-success btn-form-ajax">
      </form>
    </div>
    <div class="modal-footer">
      <div id="msg-txt"></div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap-filestyle.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.form.min.js");?>"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	load_plugins();
});
</script>
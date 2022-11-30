<?php echo link_tag('assets/uploadify/uploadify.css')."\n"?>
<script type="text/javascript" src="<?php echo base_url("assets/uploadify/jquery.uploadify.min.js");?>"></script>
    
<!-- Modal -->
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <div class="row">
        <div class="col-xs-11">
          <form>
            <div id="queue" style="max-height:200px !important;"></div>
            <input id="file_upload" name="userfile" type="file" multiple>
          </form> 
          
          <script type="text/javascript">
              $(function() {
                  $('#file_upload').uploadify({
					  'fileObjName'  : 'userfile',
                      'fileTypeExts' : '*.gif; *.jpg; *.png',
					  'buttonText'   : 'Imagens',
					  'swf'          : '<?php echo base_url('assets/uploadify/uploadify.swf');?>',
                      'uploader'     : '<?php echo base_url('imagem/up_img');?>',
					  'formData'     : { 'idgaleria' : '<?php echo $id;?>' },
					  'onUploadSuccess' : function(file, data, response){
						  //alert(data + response);
						  <?php if($gal):?>
						  var pag = '<?php echo base_url("imagem/img_gal_lista_ajax/" . $id);?>';
						  <?php elseif($dest_img):?>
						  var pag = '<?php echo base_url("imagem/img_lista/?dest_img=" . $dest_img);?>';
						  <?php elseif($usar_img):?>
						  var pag = '<?php echo base_url("imagem/img_lista/?usar_img=" . $usar_img);?>';
						  <?php else:?>
						  var pag = '<?php echo base_url("imagem/img_lista/");?>';
						  <?php endif;?>
						  navAjax(pag, null, ".pg-ajax-img-lista");
					  },
                  });
              });
          </script>
        </div>
        <div class="col-xs-1">
          <button type="button" class="close inf-tooltip" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>        
      </div>
      
      <h4 class="modal-title" id="myModalLabel">Galeria de Imagens</h4>
    </div>
    <div class="modal-body modal-scroll pg-ajax-img-lista">
      <?php include('imagem_lista_view.php');?>
    </div>
    <div class="modal-footer">
    </div>
  </div>
</div>
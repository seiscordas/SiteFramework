<?php foreach($dados as $row):?>
<div class="img-thumbnail" id="<?php echo $row->idimg;?>">
<img src="<?php echo img_size('uploads',$row->nomeImg,100,NULL,'apainel/');?>" title="">
<a href="<?php echo base_url("imagem/del/".$row->idimg);?>" class="confirma inf-tooltip" data-placement="bottom" title="Excluir esta imagem."><span class="glyphicon glyphicon-trash"></span></a>
<?php if($usar_img != 'n'):?>
<a href="#" src-data="<?php echo img_size('uploads',$row->nomeImg,100,NULL,'apainel/');?>" id-data="<?php echo $row->idimg;?>" class="inf-tooltip usa-img" data-placement="bottom" data-dest-img="<?php echo $dest_img;?>" title="Usar esta imagem."><span class="glyphicon glyphicon-ok"></span></a>
<?php endif;?>
</div>
<?php endforeach;?>
<script>
// Tootips
$('.inf-tooltip').tooltip({'placement': 'right', 'z-index': '3000'});
</script>
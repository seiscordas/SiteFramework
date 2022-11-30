$(document).ready(function(){
	// Desabilita Teclas Control e  Shift e Clique do meio
	var tecla;
	var clickMeio;
	var inputTexarea;
	$(window).on("keydown",function(event) {
		tecla = event.keyCode ? event.keyCode : (event.which ? event.which : event.charCode);
		inputTexarea = $("input, textarea").is(":focus");
		if(tecla == 122 || tecla == 123)// 122 = F11 | 123 = F12
			return false;
		else if(tecla == 8 && inputTexarea == false)// 8 = Backspace
			return false;
	});
	$(window).on("keyup",function(event) {tecla = 0;});
	$(window).on("mousedown",function(event){
		clickMeio = event.keyCode ? event.keyCode : (event.which ? event.which : event.charCode);
	});
	$(window).on("click",function(){
		if(tecla == 16 || tecla == 17 || clickMeio == 2)// 16 = Shift | 17 = Ctrl | 2 = Click do Meio
			return false;
	});	
	// Desabilita Tlecla Enter
	$("body").on("keypress", ".block-enter", function(e){if (e.which == 13){return false;}});// 13 = Enter
	// Desabilita Menu de contexto (Clique direito).
	//$(document).on("contextmenu",function(e){return false;});
	//Desativa Link '#'
	$("body").on("click",".nolink",function(){return false});
	
	//#####################//#############################
	
	// Tootips
	$('.inf-tooltip').tooltip({container: 'body'});	
	// Esconde e desabilita Inputs e Selects
	$(".form-hidden").css('display','none').find('input, select, textarea').attr('disabled','disabled');
	//Table Sorter
	$(".tablesorter").tablesorter();	
	
	////////////////////////// Mascaras para input /////////////////////////////
	//Mascara para moeda
	$('.moeda').priceFormat({
		prefix: '',
		centsSeparator: ',',
		thousandsSeparator: '.'
	});
	$("body").on("blur", ".moeda", function(){
		var moeda = $(this).val();
		if(moeda == '0,00')
			$(this).val(''); 
	});
	// Número tem q ser maior que 0
	$(".num-int").blur(function(e){if ($(this).val() < 1){$(this).val('')}});
	//Mascara Dois Digitos
	$(".mask-2-dig").mask("99");
	//Mascara Numerica
	$(".fone").mask("(99) 9999-9999");
	//Mascara Data
	$(".data").mask("99/99/9999");
	//Mascara Cpf
	$(".cpf").mask("999.999.999-99");
	//Mascara Cnpj
	$(".cnpj").mask("99.999.999/9999-99");
	//Mascara rg
	$(".rg").mask("9.999.999-9");
	//Mascara Cep
	$(".cep").mask("99999-999");
	//Mascara Ano 8
	$(".mask-ano-8").mask("9999/9999");
	//Mascara Ano 4
	$(".mask-ano-4").mask("9999");
	//Mascara Letras
	$(".so-letra").alpha();
	//Mascara Numeros
	$(".so-numero").numeric();
	//Mascara Numeros decimais
	$(".num-dec").numeric({allow:","});
	//Mascara Mês
	$(".mask-mes").keyup(function(){
		var valor = $(this).val();
		if(valor > 31)
			$(this).val('31');
		else if(valor == '00')
			$(this).val('01');
		else if(valor > 3 && valor < 10)
			$(this).val('0'+valor);
	});
	$(".mask-mes").blur(function(){
		var valor = $(this).val();
		if(valor > 0 && valor < 10)
			$(this).val('0'+valor);
		else if(valor < 1)
			$(this).val('01');
	});
	//Valida formulário
	jQuery(".validar").validationEngine('attach',{showOneMessage : true, binded: false,scroll: false});
	/*Valida Troca Senha**************************************************************/
	$("#conf_senha").keyup(function(){
		senha      = $("#senha").val();
		confirmarSenha = $("#conf_senha").val();
		if(senha == confirmarSenha)
		{
			$(".conf_senha").addClass('has-success');
			$(".conf_senha").removeClass('has-error');
		}
		else
		{
			$(".conf_senha").addClass('has-error');
			$(".conf_senha").removeClass('has-success');
		}
	});
	$('.senha').click(function(){
		var senha          = $("#senha").val();
		var confirmarSenha = $("#conf_senha").val();
		if(senha)
		{
			if(senha.length < 4)
			{
				alert("Senha deve ter no mínimo 4 caracter!");
				$("#senha").focus();
				return false;
			}
		}
		if(senha == confirmarSenha)
			return true;
		else
			return false;
	});
	//seleciona varios checkbox
	var checkAnterior;
	$(".mult-check input").click(function(event){
		checkActual = parseInt(this.id.substr(2));
		eventoShift = event.shiftKey;
		if (eventoShift)
		{
			if (checkAnterior < checkActual )
			{
				for ( i = checkAnterior ; i <= checkActual ; i++ )
				{
					elemento = "#w_"+i;
					$(elemento).attr("checked","true");
				}
			}
			else if(checkAnterior > checkActual)
			{
				for ( i = checkAnterior ; i >= checkActual ; i-- )
				{
					elemento = "#w_"+i;
					$(elemento).attr("checked","true");
				}
			}
		}
		checkAnterior = parseInt(this.id.substr(2));
	});
});
// Fim Document Read #####################
////////////
//////////
////////
//////
////
//


// Formularios Opicionais (mostra ou esconde divs se formulario for opcional)
$(function(){
	$('body').on('click','.opicional-btn',function(){
		var iddiv = $(this).attr('iddiv');
		var visible = $( "#" + iddiv ).is(':visible');
		$( "#" + iddiv ).slideToggle( "slow", function() {
			if(visible === false)
				$( "#" + iddiv ).find('input, select, textarea').prop( "disabled", false );
			else if(visible === true)
				$( "#" + iddiv ).find('input, select, textarea').prop( "disabled", true );
		});
		$(this).find("span").toggle();
		var top = $(this).offset().top - 130;
		$('html,body').animate({scrollTop: top}, 500);
		return false;
	});
});
// Transforma texto imput em Maiusculo
$(function(){
	$("body").on('blur', ".to-upper", function() {
		$(this).val($(this).val().toUpperCase());
	});
	$("body").on('keyup', ".to-upper", function() {
		$(this).css({'text-transform':'uppercase'});
	});
	$("body").on('keyup', '.form-to-upper input, .form-to-upper select, .form-to-upper textarea', function() {
		$(this).not('.btn, .cpf, .cnpj, .numeros, .fone, .data, .rg, .cep, .mask-ano-8, .mask-ano-4, .mask-mes-ano, .numeros, .num-dec, .moeda')
		.css({'text-transform':'uppercase'});
	});
	$("body").on('blur', '.form-to-upper input, .form-to-upper select, .form-to-upper textarea', function() {
		$(this).not('.btn, .cpf, .cnpj, .numeros, .fone, .data, .rg, .cep, .mask-ano-8, .mask-ano-4, .mask-mes-ano, .numeros, .num-dec, .moeda')
		.val($(this).val().toUpperCase());
	});
});

//Confirmação de exclusão #############
$(function(){
	$('body').on('click','.confirma',function(){
		if(confirm("Deseja realmente excluir este registro?\nTodos os dados relacionados serão apagados!\nNão sera possível recupera-los, a menos que os cadastre novemente.\n\nClick em \"OK\" para excluir ou \"Cancelar\" para permanecer com os dados."))
		{
			$(".tooltip").tooltip('hide');
			var pag = $(this).attr("href");
			ajax_del(pag);
			return false;
		}
		else
			return false;
	})
	$('body').on('click','.status-conf',function(){
		if(confirm("Esta ação desativará este registro, Isto não quer dizer que os dados serão apagados,\nVoce pode reativalo posteriormente.\n\nClick em \"OK\" para Confirmar ou \"Cancelar\" para não fazer nenhuma ação."))
		{
			$(".tooltip").tooltip('hide');
			var pag = $(this).attr("href");
			ajax_del(pag);
			return false;
		}
		else
			return false;
	})
	$('body').on('click','.del-ajax',function(){
		var pag = $(this).attr("href");
		ajax_del(pag);
		return false;
	})
});
function ajax_del(pag, dados){
	$.ajax({
		type: "POST",
		url: pag,
		data: dados,
		dataType: "json",
		success: function(data){
			if(data.bool == 1)
			{
				if(data.tab == 1)
				{
					$("#" + data.id + " .confirma").parent("td").html('<td colspan="100%" class="text-success text-center">'+ data.msg +'</td>');
					$("#" + data.id).fadeOut(2000);
				}
				else
				{
					$("#"+data.id).css('position','relative');
					$("#"+data.id).append('<p class="success text-center msg-del">'+ data.msg +'</p>');
					$(".msg-del").css({position:'absolute',top: '25%'});
					$("#"+data.id).fadeOut(2000);
				}
				
			}
			else
			{
				alert(data.msg);
			}
		}
	});
}
// Função Trocar classe
function troca_classe(elemento, classe_a, classe_b)
{
	if ($(elemento).hasClass(classe_a))
	{
		$(elemento).removeClass(classe_a).addClass(classe_b);
	}
	else
	{
		$(elemento).removeClass(classe_b).addClass(classe_a);
	}			  
}
// Abilita desabilita Grupo
$(function(){
	$("body").on("change" ,"#ativar-grupo" ,function(){
		if($(this).is(':checked'))
		{
			show_hide_input('#valor','#grupo');
		}
		else
		{
			show_hide_input('#grupo','#valor');
		}
	});
});
// função para mostrar e esconder elementos de formulario, abilitando e/ou desabilitando inputs, selects e textareas
function show_hide_input(elemento_hide, elemento_show)
{
	if(elemento_hide)
	{
		$(elemento_hide).fadeOut("fast");
		$(elemento_hide).find('input, select, textarea').prop('disabled',true);
	}
	if(elemento_show)
	{
		$(elemento_show).find('input, select, textarea').prop('disabled',false);
		$(elemento_show).fadeIn('slow');
	}
}
///////////// compara input com banco de dados ///////////////////
$(function(){
	$("body").on('blur', ".input-compare", function(){
		var valorAtual = $(this).attr("data-val");
		var tabela = $(this).attr('data-table');
		var pag = path + 'comparareg/verifica/' + tabela;
		var inputVal = $(this).val();
		var id = $(this).attr('id');
		var campo = $(this).parent().siblings().find('span').html();
		var dados = $(this).serialize();
		//alert(valorAtual+'\n'+inputVal+'\n'+id)
		if(valorAtual != inputVal && inputVal != '')
		{
			copara_input(pag, dados, inputVal, id, campo);
		}
		return false;
	});
});
$(function(){
	$("body").on('click', ".input-compare-btn", function(){
		$(".input-compare").each(function(index, element) {
            var valorAtual = $(this).attr("data-value");
			var tabela = $(this).attr('data-table');
			var pag = path + 'comparareg/verifica/' + tabela;
			var inputVal = $(this).val();
			var id = $(this).attr('id');
			var campo = $(this).parent().siblings().find('span').html();
			var dados = $(this).serialize();
			//alert(valorAtual+'\n'+inputVal+'\n'+id)
			if(valorAtual != inputVal && inputVal != '')
			{
				copara_input(pag, dados, inputVal, id, campo);
			}
			return false;
        });
	});
});
//Função Ajax compara input com banco de dados
function copara_input(pag, dados, inputVal, id, campo){
	$.ajax({
		type: "POST",
		url: pag,
		data: dados,
		dataType: "json",
		success: function(resultado){
			if(resultado == 1)
			{
				alert('Este dado: "' + inputVal + '" correspondente ao campo "' + campo + '" já está cadastrado e não pode ser duplicado!\n\nSe não deseja receber esta mensagem novamente, altere o valor do campo.');
				$('#'+id).focus();
				$('#'+id).focus().val('');
			}
		}
	});
}
////////////////// Pesquisa Ajax///////////////////////
$(function(){
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();
	$('body').on('keyup', ".pesq_key_ajax", function(){
		delay(function(){
			var pag = $('.form-ajax').attr("action");
			var dados = $('.form-ajax').serialize();
			navAjax(pag, dados, ".pg-ajax");
			return false;
		}, 500 );
	});
	$("body").on('click', ".pesq_btn_ajax", function(){
		delay(function(){
			var pag = $('.form-ajax').attr("action");
			var dados = $('.form-ajax').serialize();
			navAjax(pag, dados, ".pg-ajax");
			return false;
		}, 500 );
	});
});
////////////////// Envia Form Ajax///////////////////////

//Função Ajax Retorna Pagina
function navAjax(pag, dados, div){
	$.ajax({
		type: "POST",
		url: pag,
		data: dados,
		dataType: "html",
		success: function(conteudoPg){
			if(div)
				$( div ).html(conteudoPg);//BackGround e Fechar
			$(".tablesorter").tablesorter();//Table Sorter
		}
	});
}
// Pesquisa Ajax Modal
$(function(){
	var divContent;
	$('body').on('keyup', ".pesq_key_ajax_modal", function(){
		var termo = $( this ).val().length;
		if(termo > 1)
		{
			var pag = $(this).attr("data-action");
			var dados = $(this).serialize();
			divContent = $(this).attr("data-div-content");
			$.ajax({
				type: "POST",
				url: pag,
				data: dados,
				dataType: "html",
				success: function(conteudoPg){
					$("." + divContent).html(conteudoPg);//BackGround e Fechar
					//Table Sorter
					$(".tablesorter").tablesorter();
				}
			});
		}
		else
		{
			$("." + divContent).html('');
		}
		return false;
	});
});
// Função Ajax Modal
$(function(){
	var dataToglle;
	$("body").on('click', ".ajax-modal", function(e) {
		var numModal = $('.modal').length;
		dataToglle = $(this).attr('data-toggle');
		var dataTarget = $(this).attr('data-target');
		$( dataTarget ).remove();
		e.preventDefault();
		var $this = $(this);
		var destImg = $(this).attr('data-dest-img');
		if(destImg)
		{
			var $remote = $this.attr('href') + '?dest_img=' + destImg;
		}
		else
		{
			var $remote = $this.attr('href');
		}
		var $modal = $('<div class="modal" id="' + dataToglle + '"><div class="modal-body"></div></div>');
		$('body').append($modal);
		$modal.modal();
		$modal.load($remote);
	});
	$('body').on('hidden.bs.modal', '.modal',function (e) {
	  	var id = $(this).attr('id');
		$("#" + id).not('.not-ren').remove();
	})
});
// Função add / troca imagem
$(function(){
	$("body").on('click', '.usa-img', function(){
		var novaImg = $(this).attr('src-data');
		var idImg = $(this).attr('id-data');
		var destImg = $(this).attr('data-dest-img');// Destino do elemto de inserção de imagem
		$("#img-view-" + destImg).attr('src', novaImg);
		$("#fk_idimg-" + destImg).val( idImg );
		$('#img-modal').modal('hide');
	});
});
// Função add / troca galeria
$(function(){
	$("body").on('click', '.usa-gal', function(){
		var novaGal = $(this).attr('src-data');
		var idGal = $(this).attr('id-data');
		var destGal = $(this).attr('data-dest-gal');// Destino do elemto de inserção da galeria
		$("#gal-view-" + destImg).attr('src', novaImg);
		$("#fk_idgaleria").val( idImg );
		$('#gal-modal').modal('hide');
	});
});
$(".form-ajax-validate").validationEngine({
	showOneMessage : true,
	promptPosition : "top",
	binded: false,
	onValidationComplete: function(form, status){
		if(status === true)
		{
			var pag = $(".form-ajax-validate").attr("action");
			var dados = $(".form-ajax-validate").serialize();
			enviaFormAjax(pag, dados);	
			return false;				
		}
	}
});
// Envia Form Ajax
function enviaFormAjax(pag, dados){
	$.ajax({
		type: "POST",
		url: pag,
		data: dados,
		dataType: "JSON",
		success: function(retorno){
			if(retorno.loadList == '1'){
				navAjax(current_url, null, ".pg-ajax");
			}
			if(retorno.resetForm == '1'){
				var img = $(".form-ajax-validate").attr("data-dest-img");
				$(".form-ajax-validate")[0].reset();
				$("#img-view-" + img).attr('src', '');
				$("#fk_idimg-" + img).val('');
			}
			if(retorno.msgBool == '1'){
				$(".msg-txt").append("<h3 class='text-success msg pull-left'>" + retorno.msgTxt + "</h3>");
				$('.msg').fadeOut(8000);
			}
			if(retorno.fechaModal == '1'){
				$('.modal').modal('hide');
			}
		}
	});
}
// Função para carregar plugins em ajax
function load_plugins()
{
	// Tootips
	$('.inf-tooltip').tooltip({'placement': 'right', 'z-index': '3000'});
	// Validation Engine
	$(".form-ajax-validate").validationEngine({
		showOneMessage : true,
		promptPosition : "top",
		binded: false,
		onValidationComplete: function(form, status){
			if(status === true)
			{
				var pag = $(".form-ajax-validate").attr("action");
				var dados = $(".form-ajax-validate").serialize();
				enviaFormAjax(pag, dados);
				return false;				
			}
		}
	});
}
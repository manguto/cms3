
//------------------------------------------------------------------------ DATA CTRL
function exibirOcultarDatactrl(){
	
	var display = $('.data-ctrl').css('display');
	//log(display);
	
	if(display=='none'){
		exibirDatactrl();
	}else{
		ocultarDatactrl();
	}
}

function ocultarDatactrl(){
	$('.data-ctrl').slideUp();
}

function exibirDatactrl(){
	$('.data-ctrl').slideDown();
}

function data_ctrl_start(){
	$('.data-ctrl').hide();	
}


//------------------------------------------------------------------------ RESERVA OPTS

function reserva_opts_start(){
	$('.reserva_celula').mouseenter(function(){
		$(this).find('.reserva_opts').slideDown(100);
	}).mouseleave(function(){
		$(this).find('.reserva_opts').slideUp(100);
	});
}


//------------------------------------------------------------------------ CONFIRMACAO DE SELECAO DE OPCAO DE RESERVA
function confirmar(opt_href,opt_title){
	opt_href = '/transportes'+opt_href;
	if(confirm('Tem certeza que deseja '+opt_title+'?')){
		document.location = opt_href;
	}
}

//------------------------------------------------------------------------ AJUSTE DAS RESERVAS (CONTEUDO DAS CELULAS)
function reserva_celula_ajuste(){		
	
	$('td.reserva_celula.ativa').each(function(){
		var td = $(this);
		td.removeClass('ativa');
		if(td.attr('tipo')=='avulsa'){
			td.css('box-shadow','0px 2px 5px #ffc107');	
			td.css('border','solid 1px #ffc107');	
		}else{
			td.css('box-shadow','0px 2px 5px #ff0000');
			td.css('border','solid 1px #ff0000');
		}
		
		var dia = $(this).attr('dia');
		var reservaid = td.attr('reservaid');
		//log(dia);
		var conjunto = $('td[dia="'+dia+'"][reservaid="'+reservaid+'"]');
		var rowspan = conjunto.length;
		$('td.ativa[dia="'+dia+'"][reservaid="'+reservaid+'"]').remove();
		td.attr('rowspan',rowspan);
	});
}

//============================================================================================== READY?

$(document).ready(function(){
	
	//DATA CTRL
	data_ctrl_start();
	
	//RESERVA OPTS
	reserva_opts_start();
	
	//RESERVA CELULA EXIBICAO AJUSTE
	reserva_celula_ajuste();
	
});
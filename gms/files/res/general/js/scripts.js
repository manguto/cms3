//===================================================================================================================================================
// DEVELOPMENT SHOW

function verifyLogArea() {
	if ($('#log').length == 0) {
		$('body')
				.prepend(
						'<div id="log" style="position:absolute; opacity:0.5; background:#ffa; padding:10px 20px; margin:10px 20px; z-index:1;"></div>');
	}
}

function log(msg, separator) {
	verifyLogArea();
	$('#log').prepend(msg + (separator == null ? '<br />' : separator));
}

// ================================================================================================================================================
// PRODUCTION SHOW

function setMsg(type, msg) {

	if (type == 'error') {
		var process_result = $('.process-results .alert-danger');
		var timeout = 10000;
	} else if (type == 'warning') {
		var process_result = $('.process-results .alert-warning');
		var timeout = 7000;
	} else if (type == 'success') {
		var process_result = $('.process-results .alert-success');
		var timeout = 5000;
	} else {
		alert('Tipo de mensagem desconhecida (' + type + ').');
		return false;
	}
	process_result.html(msg);
	process_result.show();	
	setTimeout(function() {
		process_result.hide();
	}, timeout);

}

function setError(msg) {
	if(checkReturnedJsonObjectShortError(msg)){
		setMsg('error', msg);
	}else{
		showLongError(msg);
	}
	document.location='#header';
}
function setWarning(msg) {
	if(checkReturnedJsonObjectShortError(msg)){
		setMsg('warning', msg);	
	}else{
		showLongError(msg);
	}
	document.location='#header';
}
function setSuccess(msg) {
	if(checkReturnedJsonObjectShortError(msg)){
		setMsg('success', msg);	
	}else{
		showLongError(msg);
	}	
	document.location='#header';
}

//------------------------------------------------------------------
/** Verifica se o conteudo informado eh um objeto do tipo JSON */
function checkReturnedJsonObject(data){
	if (typeof data != 'object') {
		return false;
	} else {
		return true;
	}
}
/** Verifica se o erro entrado ah algo curto */
function checkReturnedJsonObjectShortError(data){
	var shortError = true;
	
	if(data.indexOf("<table")!=-1){
		shortError = false;
	}
	if(data.indexOf("<div")!=-1){
		shortError = false;
	}	
	if(data.indexOf("<h1")!=-1){
		shortError = false;
	}	
	if(data.indexOf("<h2")!=-1){
		shortError = false;
	}	
	if(data.indexOf("<h3")!=-1){
		shortError = false;
	}
	//but logoff/login needed
	if(data.indexOf("<html")!=-1){
		alert('Sistema Off-line. Efetue o login')
		document.location='/transportes/login';		
	}
	return shortError;
}

/** exive um erro não curto */
function showLongError(data){
	setError('Ocorreu um problema. Copie a mensagem no final da página e envie-a para o Administrador do sistema.');
	document.location = '#header';
	$('body').append('<textarea style="border:solid 1px #f00; font-size:10px; color:#f00; padding:10px; height:300px; width:98%; margin:10px;">'+data+'</textarea><hr/>');
}

// ================================================================================================================================================
// DOCUMENT READY

$(document).ready(function() {
	
});
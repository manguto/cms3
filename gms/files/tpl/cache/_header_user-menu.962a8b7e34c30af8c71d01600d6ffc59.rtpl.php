<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( checkUserLogged() ){ ?>
	<div class="row text-right">
		<div class="col text-sm text-right"><?php echo getUserName(); ?></div>
	</div>	
	<div class="row">
		<div class="col text-right">
			<a href="/admin/profile" class="btn btn-sm btn-light">Dados Pessoais</a>
			<a href="/admin/logout" class="btn btn-sm btn-light">Sair</a>
		</div>
	</div>
	
<?php }else{ ?>
	<div class="row">
		<div class="col text-right">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col text-right">			
			<a href="/admin/login" class="btn btn-sm btn-light">Login / Cadastro</a>
		</div>
	</div>
	
<?php } ?>
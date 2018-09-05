<?php if(!class_exists('Rain\Tpl')){exit;}?><a href="/" class="btn btn-sm btn-success mr-1">Home</a>

<?php if( checkUserLogged() ){ ?>

	<a href='/home' class='btn btn-sm btn-light mr-1'>Instruções</a>
	
<?php } ?>

<?php if( checkUserLoggedAdmin() ){ ?>
	
	<a href="/admin" class="btn btn-sm btn-light float-right">&#9658; Back-End</a>
	
<?php } ?>

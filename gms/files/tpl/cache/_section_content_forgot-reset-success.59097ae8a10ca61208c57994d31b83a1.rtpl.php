<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
	<div class="row">		
		<div class='col-6 alert alert-success'>
			<h4 class="alert-heading">Senha alterada com sucesso!</h4>
			<div class="form-group">
				<a href="<?php echo htmlspecialchars( $link_form_login, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-success">Clique aqui para fazer o login com sua nova senha.</a>
			</div>
		</div>
		<div class="col-6"></div>
	</div>
</div>
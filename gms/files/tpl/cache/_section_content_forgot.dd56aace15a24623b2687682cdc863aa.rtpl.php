<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
	<div class="row">		
		<div class="col-6 alert alert-warning">
			<h4 class="alert-heading">Esqueceu a sua senha?</h4>
			<br/>
			<p>Digite seu e-mail para receber as instruções de redefinição de senha.</p>			
			<form action="<?php echo htmlspecialchars( $form_action, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
				<div class="form-group">
					<input type="email" class="form-control" placeholder="Digite o seu e-mail" name="email">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-warning">Enviar e-mail de Recuperação</button>
				</div>
			</form>
		</div>
		<div class="col-6"></div>
	</div>
</div>
<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
	<div class="row">
		<div class="col-6 alert alert-success">
			<h4 class="alert-heading">Olá <?php echo htmlspecialchars( $name, ENT_COMPAT, 'UTF-8', FALSE ); ?>,</h4>
			<br />
			<h5 class="alert-heading">Digite sua nova senha:</h5>			
			<form action="<?php echo htmlspecialchars( $form_action, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
				<input type="hidden" name="code" value="<?php echo htmlspecialchars( $code, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
				<div class='form-group'>
					<input type="password" placeholder="Digite a nova senha" name="password" class="form-control">
				</div>
				<div class='form-group'>
					<button type="submit" class="btn btn-success">Salvar</button>
				</div>
			</form>
		</div>
		<div class="col-6"></div>
	</div>
</div>
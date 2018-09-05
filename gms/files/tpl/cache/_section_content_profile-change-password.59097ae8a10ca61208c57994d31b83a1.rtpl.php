<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
	<h2>Alterar Senha</h2>

	<div class="row">
		<div class="col-4">
			<form action="<?php echo htmlspecialchars( $form_action, ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
				<div class="form-group">
					<label for="current_pass">Senha Atual</label> <span class="required">*</span>
					<input type="password" class="form-control" id="current_pass" name="current_pass" value="" title="" required="required">
				</div>
				<br />
				<br />
				<div class="form-group">
					<label for="new_pass">Nova Senha</label> <span class="required">*</span>
					<input type="password" class="form-control" id="new_pass" name="new_pass" value="" required="required">
				</div>
				<div class="form-group">
					<label for="new_pass_confirm">Confirme a Nova Senha</label> <span class="required">*</span>
					<input type="password" class="form-control" id="new_pass_confirm" name="new_pass_confirm" value="" required="required">
				</div>
				<button type="submit" class="btn btn-success">Salvar</button>
			</form>
		</div>
	</div>
	
</div>
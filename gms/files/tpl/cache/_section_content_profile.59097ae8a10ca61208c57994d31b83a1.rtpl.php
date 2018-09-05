<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
	<h2>Minha Conta</h2>
	<br/>				
	<div class="row">
		<div class="col-6">
			<form method="post" action="<?php echo htmlspecialchars( $form_action, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
				<div class="form-group">
					<label for="name">Nome</label>
					<span class="required">*</span>
					<input type="text" class="form-control" id="name" name="name" placeholder="Digite o name aqui" value="<?php echo htmlspecialchars( $user["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required="required">
				</div>
				<div class="form-group">
					<label for="email">E-mail</label>
					<span class="required">*</span>
					<input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail aqui" value="<?php echo htmlspecialchars( $user["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required="required">
				</div>
				<br/>				
				<div class="form-group">
					<a href="/" class="btn btn-danger mr-2">Cancelar</a>									
					<a href='<?php echo htmlspecialchars( $link_change_password, ENT_COMPAT, 'UTF-8', FALSE ); ?>' class='btn btn-warning mr-2' >Atualizar Senha</a>
					<button type="submit" class="btn btn-success mr-2">Salvar Alterações</button>
				</div>
			</form>
		</div>
	</div>
</div>
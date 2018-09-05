<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("../html/_open");?> <?php require $this->checkTemplate("_header");?>
<section>
	<?php require $this->checkTemplate("../general/_section_top");?>
	<div class="container">
		<h2>Visualizar Usuário</h2>
		
			<div class='form-group'>
				<label for="name">Nome</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome" value="<?php echo htmlspecialchars( $user["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled="disabled">
			</div>
			<div class='form-group'>
				<label for="login">Login</label>
				<input type="text" class="form-control" id="login" name="login" placeholder="Digite o login" value="<?php echo htmlspecialchars( $user["login"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled="disabled">
			</div>
			<div class='form-group'>
				<label for="email">E-mail</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail" value="<?php echo htmlspecialchars( $user["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled="disabled">
			</div>
			<div class="form-group">
				<label for="phone">Telefone</label>
				<input type="tel" class="form-control" id="phone" name="phone" placeholder="Digite o telefone aqui" value="<?php echo htmlspecialchars( $user["phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled="disabled">
			</div>
			<div class='form-group'>
				<label>
					<input type="checkbox" name="adminzoneaccess" value="<?php echo htmlspecialchars( $user["adminzoneaccess"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $user["adminzoneaccess"] == 1 ){ ?>checked<?php } ?> disabled="disabled">
					Acesso de Administrador
				</label>
			</div>
			<a href="/admin/users" class="btn btn-primary">Voltar</a>
		
	</div>
</section>
<?php require $this->checkTemplate("_footer");?> <?php require $this->checkTemplate("../html/_close");?>

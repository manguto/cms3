<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("../html/_open");?> <?php require $this->checkTemplate("_header");?>

<section>
	<?php require $this->checkTemplate("../general/_section_top");?>
	<div class="container">
		<div class="row">
			<div class="col-4">
				<h2>Novo Usuário</h2>
				<form action="/admin/users/create" method="post"
					class="mr-auto ml-auto">
		
					<div class='form-group'>
						<label for="name">Nome</label> <input type="text" id="name" name="name"
							placeholder="Digite o name" value="<?php echo htmlspecialchars( $temp, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control"
						>
					</div>
					<div class='form-group'>
						<label  for="login">Login</label> <input type="text" id="login" name="login"
							placeholder="Digite o login" value="<?php echo htmlspecialchars( $temp, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control"
						>
					</div>
					<div class='form-group'>
						<label  for="email">E-mail</label> <input type="email" id="email" name="email"
							placeholder="Digite o e-mail" value="<?php echo htmlspecialchars( $temp, ENT_COMPAT, 'UTF-8', FALSE ); ?>@teste.com"
							class="form-control"
						>
					</div>
					<div class="form-group">
						<label for="phone">Telefone</label> <input type="tel"
							class="form-control" id="phone" name="phone"
							placeholder="Digite o telefone aqui" value="<?php echo htmlspecialchars( $temp, ENT_COMPAT, 'UTF-8', FALSE ); ?>"
						>
					</div>
					<div class='form-group'>
						<label  for="password">Senha</label> <input type="password" id="password"
							name="password" placeholder="Digite a senha" value="<?php echo htmlspecialchars( $temp, ENT_COMPAT, 'UTF-8', FALSE ); ?>"
							class="form-control"
						>
					</div>
					<div class='form-group'>
						<label  for="adminzoneaccess"> <input type="checkbox" name="adminzoneaccess" value="1" checked > Acesso de Administrador</label>
					</div>
					<div class='form-group'>
						<button type="submit" class="btn btn-success">Cadastrar</button>
					</div>
		
				</form>
			</div>
		</div>
		
	</div>
</section>

<?php require $this->checkTemplate("_footer");?> <?php require $this->checkTemplate("../html/_close");?>

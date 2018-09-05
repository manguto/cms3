<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("../html/_open");?> <?php require $this->checkTemplate("_header");?>

<section>
	<?php require $this->checkTemplate("../general/_section_top");?>
	<div class="container">
		<div class="row">
			<div class="col-4"></div>
			<div class="col-4 card p-4 pb-5 switch switch-10">
				<h2>Entrar</h2>
				<br />
				<form action="/admin/login" method="post">
					<div class="form-group">
						<label for="login">Login:</label> <input type="text" name="login"
							class="form-control" placeholder="Digite aqui seu Login"
							autofocus="autofocus"
						>
					</div>
					<div class="form-group">
						<label for="password">Senha:</label> <input type="password"
							name="password" class="form-control"
							placeholder="Digite aqui sua senha"
						>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Entrar</button>
					</div>
					<div class="form-group">
						<a href="/forgot">Esqueci minha senha</a><br />
					</div>
				</form>

			</div>
			<div class="col-4"></div>
		</div>
	</div>
</section>

<?php require $this->checkTemplate("_footer");?> <?php require $this->checkTemplate("../html/_close");?>

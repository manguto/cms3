<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("../html/_open");?> <?php require $this->checkTemplate("_header");?>
<section>
	<?php require $this->checkTemplate("../general/_section_top");?>
	<div class="container">
		<div class="row">
			<div class="col-4"></div>
			<div class="col-4 card p-4 pb-5" style="border-radius: 10px; box-shadow: 0px 5px 20px #aaa;">
				<h2>Cadastro</h2>
				<br />
				<form id="register-form-wrap" action="/register" method="post">
					<p>
						<label for="nome2">
							Nome
							<span class="required">*</span>
						</label>
						<input type="text" id="nome2" name="name" value="<?php echo htmlspecialchars( $registerFormValues["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" required="required">
					</p>
					<p>
						<label for="emai2l">
							E-mail
							<span class="required">*</span>
						</label>
						<input type="text" id="email2" name="email" value="<?php echo htmlspecialchars( $registerFormValues["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" required="required">
					</p>
					<p>
						<label for="phone2"> Telefone </label>
						<input type="text" id="phone2" name="phone" value="<?php echo htmlspecialchars( $registerFormValues["phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control">
					</p>
					<p>
						<label for="senha2">
							Senha
							<span class="required">*</span>
						</label>
						<input type="password" id="senha2" name="password" required="required" class="form-control">
					</p>
					<div class="clear"></div>
					<br />
					<p>
						<input type="submit" value="Criar Conta" class="btn btn-warning">
					</p>
					<div class="clear"></div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php require $this->checkTemplate("_footer");?> <?php require $this->checkTemplate("../html/_close");?>

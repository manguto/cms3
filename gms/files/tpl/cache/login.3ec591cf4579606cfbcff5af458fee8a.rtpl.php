<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("../html/_open");?> <?php require $this->checkTemplate("_header");?>
<section>
	<?php require $this->checkTemplate("../general/_section_top");?>
	<div class="container">
		<div class="row">
			<div class="col-4"></div>
			<div class="col-4 card p-4 pb-5 " style="border-radius: 10px; box-shadow: 0px 5px 20px #aaa;">
				<h2>Entrar</h2>
				<br />
				<form action="/login" method="post">
					<p>
						<label for="login">
							E-mail
							<span class="required">*</span>
						</label>
						<input type="text" id="login" name="login" value="" class="form-control" required="required" autofocus="autofocus" placeholder="Digite aqui seu E-mail">
					</p>
					<p>
						<label for="senha">
							Senha
							<span class="required">*</span>
						</label>
						<input type="password" id="senha" name="password" value="" class="form-control" required="required" placeholder="Digite aqui a sua Senha">
					</p>
					<div class="clear">
						<br />
					</div>
					<p>
						<input type="submit" value="Login" class="btn btn-success">
					</p>
					<p class="lost_password">
						<a href="/forgot">Esqueceu a sua senha?</a>
					</p>
					<div class="clear"></div>
				</form>
			</div>
			<div class="col-4"></div>
		</div>
	</div>
</section>
<?php require $this->checkTemplate("_footer");?> <?php require $this->checkTemplate("../html/_close");?>
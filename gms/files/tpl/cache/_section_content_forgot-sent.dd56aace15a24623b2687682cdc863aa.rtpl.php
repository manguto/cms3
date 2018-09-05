<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
	<div class="row">		
		<div class="col-6 alert alert-success">
			<h4 class="alert-heading">Instruções enviadas com sucesso!</h4>
			<br/>
			<p class='text-justify'>Uma mensagem foi enviada com as instruções para recuperação da sua senha.</p>
			<p>Por favor, verifique a Caixa de Entrada do seu email: <b><?php echo htmlspecialchars( $email, ENT_COMPAT, 'UTF-8', FALSE ); ?></b>.</p>
			<br />
			<p>
				<a href='<?php echo htmlspecialchars( $emailUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>' target="_blank" class="btn btn-success" title='<?php echo htmlspecialchars( $emailUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>'> <?php echo htmlspecialchars( $emailName, ENT_COMPAT, 'UTF-8', FALSE ); ?> </a>
			</p>
			<br/>
			<br/>
		</div>
		<div class="col-6"></div>
	</div>
</div>
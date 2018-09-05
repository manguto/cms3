<?php if(!class_exists('Rain\Tpl')){exit;}?><header id='header' class='site'>
	<div class="container">
		<div class="row">
			<div class="col-8">
				<?php require $this->checkTemplate("_header_title");?>
			</div>
			<div class="col-4 text-align-right">
				<?php require $this->checkTemplate("_header_user-menu");?>				
			</div>
		</div>
		<div class="row">	
			<div class="col-12 pt-1 pb-1">
				<nav>
					<?php require $this->checkTemplate("_header_menu");?>	
				</nav>
			</div>
		</div>
	</div>
</header>


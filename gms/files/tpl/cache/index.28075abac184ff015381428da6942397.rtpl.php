<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("../html/_open");?> <?php require $this->checkTemplate("_header");?>
<section>
	<?php require $this->checkTemplate("../general/_section_top");?>
	<div class="container">
		<div class="row mb-5">
			<div class="col-12">
				<h1 class=''>Bem vindo(a) ao</h1>
				<h1 class='display-4'><?php echo SIS_NAME; ?></h1>
			</div>
		</div>
	</div>
</section>
<style type="text/css">
.ramal{
	color:#fff;
	font-size:64px;	
	text-shadow:<?php echo str_repeat('0px 1px 4px #005,',10); ?>0px 0px 0px #fff;
}
</style>
<?php require $this->checkTemplate("_footer");?> <?php require $this->checkTemplate("../html/_close");?>

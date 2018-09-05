<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( checkSuccess() || checkWarning() || checkError() ){ ?>
<script>
	var tempo_ocultar = 5*1000; //seg
	var tempo_efeito = 3*1000; //seg
	setTimeout(function() {
		$('.process-results').fadeOut(tempo_efeito);		
	}, tempo_ocultar);
</script>
<?php } ?>
<div class="container" id="process-results">
	<div class="row">
		<div class="col-12 process-results">			
			<div class="row">
				<div class="col-12 alert alert-danger mb-4 p-3" style="background:#f00; display:<?php if( checkError() ){ ?>block<?php }else{ ?>none<?php } ?>;"><?php echo getError(); ?></div>
			</div>			
			<div class="row">
				<div class="col-12 alert alert-warning mb-4 p-3" style="background:#fd0; display:<?php if( checkWarning() ){ ?>block<?php }else{ ?>none<?php } ?>;"><?php echo getWarning(); ?></div>
			</div>			
			<div class="row">
				<div class="col-12 alert alert-success mb-4 p-3" style="background:#0c0; display:<?php if( checkSuccess() ){ ?>block<?php }else{ ?>none<?php } ?>;"><?php echo getSuccess(); ?></div>
			</div>			
		</div>		
	</div>
</div>

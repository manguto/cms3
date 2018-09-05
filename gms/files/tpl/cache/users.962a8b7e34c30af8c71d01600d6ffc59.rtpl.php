<?php if(!class_exists('Rain\Tpl')){exit;}?><?php require $this->checkTemplate("../html/_open");?> <?php require $this->checkTemplate("_header");?>
<section>
	<?php require $this->checkTemplate("../general/_section_top");?>
	<div class="container">
		<h2>Lista de Usuários</h2>
		<br />
		<a href="/admin/users/create" class='btn btn-success btn-sm '>Cadastrar Usuário</a>
		<br />
		<br />
		<table class="table">
			<thead class='thead=light'>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nome</th>
					<th scope="col">Login</th>
					<th scope="col">E-mail</th>
					<th scope="col">Administrador</th>
					<th scope="col">Opções</th>
				</tr>
			</thead>
			<tbody>
				<?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
				<tr>
					<th scope="row"><?php echo htmlspecialchars( $value1["userid"], ENT_COMPAT, 'UTF-8', FALSE ); ?></th>
					<td><?php echo htmlspecialchars( $value1["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
					<td><?php echo htmlspecialchars( $value1["login"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
					<td><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
					<td><?php if( $value1["adminzoneaccess"] == TRUE ){ ?>Sim<?php }else{ ?>Não<?php } ?></td>
					<td>
						<a href="/admin/users/<?php echo htmlspecialchars( $value1["userid"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class='btn btn-success btn-sm float-left mr-1'>Visualizar</a>
						<a href="/admin/users/<?php echo htmlspecialchars( $value1["userid"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/edit" class='btn btn-warning btn-sm float-left mr-1'>Editar</a>
						<a href="/admin/users/<?php echo htmlspecialchars( $value1["userid"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" class='btn btn-danger btn-sm float-left mr-1' onclick="return confirm('Deseja realmente excluir este registro?')">Excluir</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</section>
<?php require $this->checkTemplate("_footer");?> <?php require $this->checkTemplate("../html/_close");?>

<!DOCTYPE html>
<html>
<head>
	<title>Bem-vindo, <?php echo $_SESSION['nome']; ?></title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/feed.css" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>estilos/comunidade.css" rel="stylesheet">


</head>

<body>

	<section class="feed-main">
		<?php 
			include('includes/sidebar.php'); 
		?>
		<div class="feed">
			<div class="comunidade">
				<div class="comunidade-container-amigos">
					<h4>Amigos</h4>
					<div class="comunidade-container-amigos-wraper">
						<?php foreach (\RedeSocialCosplay\Models\UsuariosModel::listarAmigos() as $key => $value) {
							
						?>
						<div class="comunidade-container-amigos-usuario">
							<div class="comunidade-container-amigos-usuario-img">
								<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
							</div>
							<div class="comunidade-container-amigos-usuario-info">
								<h2><?php echo $value['nome']; ?></h2>
								<p><?php echo $value['email']; ?></p>
								<div class="btn-amigos-ver-perfil">
									<a href="">Ver Perfil</a>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<br/>

				<div class="comunidade-container-comunidade">
					<h4>Comunidade</h4>
					<div class="comunidade-container-comunidade-wraper">
						<?php
							$comunidade = \RedeSocialCosplay\Models\UsuariosModel::listarComunidade();
							foreach ($comunidade as $key => $value) {

								if (\RedeSocialCosplay\Models\UsuariosModel::verificarSeAmizadeExiste($value['id'])) {
									continue;
								}


								if ($value['id'] == $_SESSION['id']) {
									continue;
								}
							
						?>
						<div class="comunidade-container-comunidade-usuario">
							<div class="comunidade-container-comunidade-usuario-img">
								<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
							</div>
							<div class="comunidade-container-comunidade-usuario-info">
								<h2><?php echo $value['nome'];?></h2>
								<p><?php echo $value['email'];?></p>
								<div class="btn">
									<div class="btn-solicitar-amizade">
										<?php 
											if (\RedeSocialCosplay\Models\UsuariosModel::existePedidoAmizade($value['id'])) {
												
										?>
										<a class="botao-solicitar" href="<?php echo INCLUDE_PATH ?>comunidade?solicitarAmizade=<?php echo $value['id'];?>">Solicitar Amizade</a> 
										<?php } else{?>

										<a class="botao-pendente" href="javascript:void(0)">Solicitação Pendente</a>
										<?php } ?>
									</div>
									<div class="btn-ver-perfil">
										<a href="">Ver Perfil</a>
									</div>
								</div>
							</div>	
						</div>
						<?php
						}
						?>	
					</div>
				</div>
			</div>
		</div><!--feed-->
	</section>


</body>


</html>
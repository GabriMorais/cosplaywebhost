<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bem vindo, <?php echo $_SESSION['nome']; ?> </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href=" <?php echo INCLUDE_PATH_STATIC ?>estilos/feed.css" rel="stylesheet">
    <link href=" <?php echo INCLUDE_PATH_STATIC ?>estilos/comunidade.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.4.min.js"
  integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
  crossorigin="anonymous"></script>
</head>
<body>

    <section class="feed-main">
        <?php 
			include('includes/sidebar.php'); 
		?>
            
        <div class = "feed">
            <div class="feed-wraper">
                <div class = "feed-form">
                 
                   
                            <button id='click-ajuda'> Ajuda</button>       
                      
          
                            <button id='click-tag-imagem'> Adicionar tag de Imagem </button>   
                     
                    <form method="post" enctype="multipart/form-data" name="teste">
                        <textarea required="" name = "texto_post"></textarea>
                        <input type="file"   name=  "file">
                        <input type="hidden" name = "post_feed">
                        <input type="submit" name = "acao" value="Postar">
                    </form>
                    <script type="text/javascript">
                            //$('#click-ajuda').on('click',function(){
                            document.getElementById('click-ajuda').onclick = function(){
                                swal.fire({title:'Adicionar Imagem',
                                    text:'Você pode adicionar imagens de 2 formas',
                                    showCancelButton: true,
                                    type: 'warning',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Primeira forma',
                                    cancelButtonText: 'Segunda forma'
                                    }).then((result) => {
                                    if (result.value) {
                                    swal.fire( 'primeira forma' ,
                                          'adicionando a tag de imagem no botão "Adicionar TAG" e colocando o link da imagem que você pretende postar APOS O CARACTER = Ex: [imagem=https://media.istockphoto.com/id/622315686/pt/foto/cosplayers-pose-for-a-selfie-at-the-yorkshire-cosplay-convention.jpg?s=612x612&w=0&k=20&c=cVGqgAXyw7rQn1zHaQtf1pRbYIqMPJO7eUWgInKGst8=]')}
                                    else{swal.fire('Segunda forma','Faça upload da imagem no botão "Escolher Arquivo"!')}
                                    })
                            }
    

                    $('#click-tag-imagem').on('click',function(){
                               document.teste.texto_post.value +='[imagem=]'
                            })
            
                    </script>
                    
                </div>

                <?php
                    $Posts = \RedeSocialCosplay\Models\HomeModel::BuscarPostsFeed();
                    foreach ($Posts as $key => $value) {
                                                        		

                ?>
                <div class = "feed-post"> 
                    <div class = "feed-post-autor">
                        <div class = "feed-post-autor-foto">
                        <?php
							if($value['img'] == ''){
						?>
						<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
					<?php }else { ?>
						<img src="<?php echo INCLUDE_PATH ?>/<?php echo $value['img'] ?>" />
					<?php } ?>  
                        </div>
                        <div class = "feed-post-autor-informacoes">
                            <h3><?php echo $value['usuario']?></h3> 
                            <p><?php echo date('d/m/Y H:i:s',strtotime($value['data'])) ?></p>    
                        </div>
                    </div>
                    <div class = "feed-post-autor-texto">
                        <?php echo $value['conteudo'];
                       //echo '<img style="max-width:350px;width:200%;" src="'.INCLUDE_PATH.'/'.$value['imgPost'].'" />'; 
                    
						if($value['imgPost'] <> ''){
                        ?>
                        <img src="<?php echo INCLUDE_PATH ?>/<?php echo $value['imgPost'] ?>" />  
                        <?php } ?> 
                         
                       
                    </div>

                    <div class='btn'>
                        <div class="btn-solicitar-amizade">
    						<?php 
    							if ( ((int)$value['statuss'] == 0)  and (\RedeSocialCosplay\Models\UsuariosModel::usuarioModerador($_SESSION['id']))){
                                        		
    						?>
    							<a class="botao-solicitar" href="<?php echo INCLUDE_PATH ?>home?habilitarPost=<?php echo $value['id'];?>">Habilitar Post</a> 
    						<?php }?>
                        </div> 
                        
                        <div class="btn-solicitar-amizade">
    						<?php 
    							if (\RedeSocialCosplay\Models\UsuariosModel::usuarioModerador($_SESSION['id']) or (int)$value['usuario_id'] == $_SESSION['id'] ){
    						?>
    							<a class="botao-solicitar" href="<?php echo INCLUDE_PATH ?>home?excluirPost=<?php echo $value['id'];?>">Excluir Post</a> 
    						<?php }?>
                        </div> 
                        
                    </div>
					<?php 
                    ?>        

                </div>

                <?php } ?>
            </div>
            <div class = "solicitacoes-de-amizade">
                <h2>Solicitações de amizade</h2> 
                <?php
                    foreach ( \RedeSocialCosplay\Models\UsuariosModel::listarSolicitacoesAmizades() as $key => $value) {
                        
                        $usuarioInfo = \RedeSocialCosplay\Models\UsuariosModel::getUsuario($value['enviou']);
                ?>
                <div class = "solicitacoes-de-amizade-disponiveis">
                    <?php
									if($usuarioInfo['img'] == ''){
								?>
								<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />

							<?php }else{ ?>
								<img src="<?php echo INCLUDE_PATH ?>/<?php echo $usuarioInfo['img'] ?>" />
							<?php } ?>
                    <div class = "solicitacoes-de-amizade-disponiveis-informacoes"> 
                        <h4><?php echo $usuarioInfo['nome']?></h4>
                        <p><a href="<?php echo INCLUDE_PATH ?>?aceitarAmizade=<?php echo $usuarioInfo['id']?>">Aceitar</a> | <a href="<?php echo INCLUDE_PATH ?>?recusarAmizade=<?php echo $usuarioInfo['id']?>">Recusar</a></p>  
                    </div>
                            
                </div> 
                <?php } ?> 
            </div>    
        </div>
    </section>
    
</body>
</html>
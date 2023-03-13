<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bem vindo, <?php echo $_SESSION['nome']; ?> </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href=" <?php echo INCLUDE_PATH_STATIC ?>estilos/feed.css" rel="stylesheet">
</head>
<body>

    <section class="feed-main">
        <?php 
			include('includes/sidebar.php'); 
		?>
            
        <div class = "feed">
            <div class="feed-wraper">
                <div class = "feed-post"> 
                    <div class = "feed-post-autor">
                        <div class = "feed-post-autor-foto">
                            <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" >    
                        </div>
                        <div class = "feed-post-autor-informacoes">
                            <h3>Gabi</h3> 
                            <p>11:11</p>    
                        </div>
                    </div>
                    <div class = "feed-post-autor-texto-do-post">
                        <p>Cosplay é um termo em inglês, formado pela junção das palavras costume (fantasia) e roleplay (brincadeira ou interpretação). É considerado um hobby onde os participantes se fantasiam de personagens fictícios da cultura pop japonesa.</p>
                        <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" >
                    </div>
                </div>

                <div class = "feed-post"> 
                    <div class = "feed-post-autor">
                        <div class = "feed-post-autor-foto">
                            <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" >    
                        </div>
                        <div class = "feed-post-autor-informacoes">
                            <h3>Gabi</h3> 
                            <p>11:11</p>    
                        </div>
                    </div>
                    <div class = "feed-post-autor-texto-do-post">
                            <p>Cosplay é um termo em inglês, formado pela junção das palavras costume (fantasia) e roleplay (brincadeira ou interpretação). É considerado um hobby onde os participantes se fantasiam de personagens fictícios da cultura pop japonesa.</p>
                    </div>
                </div>

                <div class = "feed-post"> 
                    <div class = "feed-post-autor">
                        <div class = "feed-post-autor-foto">
                            <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" >    
                        </div>
                        <div class = "feed-post-autor-informacoes">
                            <h3>Gabi</h3> 
                            <p>11:11</p>    
                        </div>
                    </div>
                    <div class = "feed-post-autor-texto-do-post">
                            <p>Cosplay é um termo em inglês, formado pela junção das palavras costume (fantasia) e roleplay (brincadeira ou interpretação). É considerado um hobby onde os participantes se fantasiam de personagens fictícios da cultura pop japonesa.</p>
                    </div>
                </div>

                <div class = "feed-post"> 
                    <div class = "feed-post-autor">
                        <div class = "feed-post-autor-foto">
                            <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" >    
                        </div>
                        <div class = "feed-post-autor-informacoes">
                            <h3>Gabi</h3> 
                            <p>11:11</p>    
                        </div>
                    </div>
                    <div class = "feed-post-autor-texto-do-post">
                            <p>Cosplay é um termo em inglês, formado pela junção das palavras costume (fantasia) e roleplay (brincadeira ou interpretação). É considerado um hobby onde os participantes se fantasiam de personagens fictícios da cultura pop japonesa.</p>
                    </div>
                </div>

                <div class = "feed-post"> 
                    <div class = "feed-post-autor">
                        <div class = "feed-post-autor-foto">
                            <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" >    
                        </div>
                        <div class = "feed-post-autor-informacoes">
                            <h3>Gabi</h3> 
                            <p>11:11</p>    
                        </div>
                    </div>
                    <div class = "feed-post-autor-texto-do-post">
                            <p>Cosplay é um termo em inglês, formado pela junção das palavras costume (fantasia) e roleplay (brincadeira ou interpretação). É considerado um hobby onde os participantes se fantasiam de personagens fictícios da cultura pop japonesa.</p>
                    </div>
                </div>

                <div class = "feed-post"> 
                    <div class = "feed-post-autor">
                        <div class = "feed-post-autor-foto">
                            <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" >    
                        </div>
                        <div class = "feed-post-autor-informacoes">
                            <h3>Gabi</h3> 
                            <p>11:11</p>    
                        </div>
                    </div>
                    <div class = "feed-post-autor-texto-do-post">
                            <p>Cosplay é um termo em inglês, formado pela junção das palavras costume (fantasia) e roleplay (brincadeira ou interpretação). É considerado um hobby onde os participantes se fantasiam de personagens fictícios da cultura pop japonesa.</p>
                    </div>
                </div>
            </div>
            <div class = "solicitacoes-de-amizade">
                <h2>Solicitações de amizade</h2> 
                <?php
                    foreach ( \RedeSocialCosplay\Models\UsuariosModel::listarSolicitacoesAmizades() as $key => $value) {
                        $usuarioInfo = \RedeSocialCosplay\Models\UsuariosModel::getUsuario($value['enviou']);
                ?>
                <div class = "solicitacoes-de-amizade-disponiveis">
                    <img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" >
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
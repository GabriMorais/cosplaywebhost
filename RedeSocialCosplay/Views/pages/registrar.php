<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registrar</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href=" <?php echo INCLUDE_PATH_STATIC ?>estilos/style.css" rel="stylesheet">
</head>
<body>
    <div class = "sidebar"></div>
    <div class = "form-container-login">
        
        <div class = "form-login">
            <div class = "logo-do-login"> 
                <img src="<?php echo INCLUDE_PATH_STATIC ?>images/logo.svg">
                <p>Testando nova rede social cosplay.</p>
            </div>
            <h4 style = "text-align: center;">Criar sua Conta na cosplay!</h4>
            <form method = "post">
                <input type="text" name="nome" placeholder = "Seu nome">
                <input type="text" name="email" placeholder = "E-mail">
                <input type="password" name="senha"placeholder = "Senha">
                <input type="submit" name= "acao" value="Criar Conta">
                <input type="hidden" name="registrar" value="registrar">
            </form>
        </div>
    </div>
</body>
</html>	
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href=" <?php echo INCLUDE_PATH_STATIC ?>estilos/style.css" rel="stylesheet">
</head>
<body>
    <div class = "sidebar"></div>
    <div class = "form-container-login">
        
        <div class = "form-login">
            <div class = "logo-do-login"> 
                <img src="<?php echo INCLUDE_PATH_STATIC ?>images/logo-cosplay.svg">
                <p>Testando nova rede social cosplay.</p>
            </div>
            <form method = "post">
                <input type="text" name="email" placeholder = "E-mail">
                <input type="password" name="senha"placeholder = "Senha">
                <input type="submit" name= "acao" value="Logar">
                <input type="hidden" name="login" value="login">
            </form>
            <p><a href="<?php echo INCLUDE_PATH ?>registrar">Criar Conta</a></p>
        </div>
    </div>
</body>
</html>
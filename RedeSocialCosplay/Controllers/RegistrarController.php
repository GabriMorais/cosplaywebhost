<?php

    namespace RedeSocialCosplay\Controllers;
    
    class RegistrarController{


        public function index(){
            if(isset($_POST['registrar'])){
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha']; 
                
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    \RedeSocialCosplay\Utilidades::alerta('E-mail inválido.');   
                    \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH.'registrar');  
                }

                else if(strlen($senha)<6){
                    \RedeSocialCosplay\Utilidades::alerta('Senha curta.');   
                    \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH.'registrar');    
                }else if(\RedeSocialCosplay\Models\UsuariosModel::verificarSeEmailExiste($email)){
                    \RedeSocialCosplay\Utilidades::alerta('E-mail já cadastrado.');   
                    \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH.'registrar');     
                }
                
                else{
                    $senha = \RedeSocialCosplay\Bcrypt::hash($senha);
                    $registro = \RedeSocialCosplay\mySQL::conectar()->prepare("Insert into usuarios values (null,?,?,?,0,'')");
                    $registro->execute(array($nome,$email,$senha));

                    \RedeSocialCosplay\Utilidades::alerta('Registrado com sucesso!');   
                    \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);
                }
            }
            \RedeSocialCosplay\Views\MainView::render('registrar');
             
        }
    }
?>
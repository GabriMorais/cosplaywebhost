<?php

    namespace RedeSocialCosplay\Controllers;
    
    class HomeController{


        public function index(){


            if(isset($_GET["loggout"])){
                session_unset();
                session_destroy();
                \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);

            }

            if (isset($_SESSION['login'])){
                if(isset($_GET['recusarAmizade'])){
                    $idEnviou = (int) $_GET['recusarAmizade'];   
                    \RedeSocialCosplay\Models\UsuariosModel::atualizarStatusPedidoAmizade($idEnviou,0);
                    \RedeSocialCosplay\Utilidades::alerta('Amizade Recusada.');
                    \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);
                }else if (isset($_GET['aceitarAmizade'])) {
                    $idEnviou = (int) $_GET['aceitarAmizade'];
                    if (\RedeSocialCosplay\Models\UsuariosModel::atualizarStatusPedidoAmizade($idEnviou,1)) {
                        \RedeSocialCosplay\Utilidades::alerta('Amizade Aceita.'); 
                        \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);
                    } else {
                        \RedeSocialCosplay\Utilidades::alerta('Algo de errado não está certo!!!'); 
                        \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);
                    }
                    
                }


                if(isset($_POST['post_feed'])){
                    if($_POST['texto_post'] == '' ){
                        \RedeSocialCosplay\Utilidades::alerta('Post vazio não pode ser publicado'); 
                        \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);
                    }
                    \RedeSocialCosplay\Models\HomeModel::postFeed($_POST['texto_post']);
                    \RedeSocialCosplay\Utilidades::alerta('Postagem publicada'); 
                    \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);    
                }

                if (isset($_GET['habilitarPost'])){
                    $idPost = (int) $_GET['habilitarPost']; 
                    \RedeSocialCosplay\Utilidades::alerta($idPost); 
                    \RedeSocialCosplay\Models\HomeModel::habilitarPost($idPost);
                    \RedeSocialCosplay\Utilidades::alerta('Post Habilitado'); 
                    \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);    
                }
                \RedeSocialCosplay\Views\MainView::render('home');
            }else {

                if(isset($_POST['login'])){
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];

                    $verifica = \RedeSocialCosplay\mySQL::conectar()->prepare("select * from usuarios where email = ? ");
                    $verifica->execute(array($email));

                    if ($verifica->rowCount()==0){
                        \RedeSocialCosplay\Utilidades::alerta('Usuário não cadastrado.');   
                        \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);
                    }else{
                        $dadosBanco = $verifica->fetch();
                        $senhabanco = $dadosBanco['senha'];
                        if( \RedeSocialCosplay\Bcrypt::check($senha,$senhabanco)){
                            $_SESSION['login'] = $dadosBanco['email'];
                            $_SESSION['id']    = $dadosBanco['id'];
                            $_SESSION['nome']  = explode(' ',$dadosBanco['nome'])[0];
                            \RedeSocialCosplay\Utilidades::alerta('Logado.');   
                            \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH); 
                        }else{
                            \RedeSocialCosplay\Utilidades::alerta('Senha Incorreta.');   
                            \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);   
                        } 
                    }

                }
                \RedeSocialCosplay\Views\MainView::render('login');
            }    
        }
    }
?>
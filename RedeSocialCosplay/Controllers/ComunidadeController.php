<?php

    namespace RedeSocialCosplay\Controllers;
    
    class ComunidadeController{

        public function index(){

            if (isset($_SESSION['login'])){
                if (isset($_GET['solicitarAmizade'])) {
                    $idPara = (int)$_GET['solicitarAmizade'];
                    if (\RedeSocialCosplay\Models\UsuariosModel::solicitarAmizade($idPara)) {
                        \RedeSocialCosplay\Utilidades::alerta('Amizade Solicitada.');  
                        \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH.'comunidade');   
                    }else {
                        \RedeSocialCosplay\Utilidades::alerta('Erro.');
                        \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH.'comunidade'); 
                    }
                }
                \RedeSocialCosplay\Views\MainView::render('comunidade');
            }else {
                \RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);
            }
        }
    }
?>
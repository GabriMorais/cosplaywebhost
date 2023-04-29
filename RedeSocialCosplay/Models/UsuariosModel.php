<?php
    namespace RedeSocialCosplay\Models;

    class UsuariosModel{

        public static function verificarSeEmailExiste($email){
            $pdo = \RedeSocialCosplay\mySQL::conectar();
            $verifica = $pdo->prepare("Select email from usuarios where email = ?");
            $verifica->execute(array($email));

            if ($verifica->rowCount() == 1){
                return true;
            }
            else{
                return false;
            }

        }
        public static function listarComunidade(){
            $pdo = \RedeSocialCosplay\mySQL::conectar();
            $comunidade = $pdo->prepare("select * from usuarios");
            $comunidade->execute();

            return $comunidade->fetchAll();
        }

        public static function solicitarAmizade($idPara){
            $pdo = \RedeSocialCosplay\mySQL::conectar();

            $verificarAmizade = $pdo->prepare("select * from amizades where (enviou = ? and recebeu = ?) or (enviou = ? and recebeu = ?)");
            $verificarAmizade->execute(array($_SESSION['id'],$idPara,$idPara,$_SESSION['id'])) ;

            if ($verificarAmizade->rowCount() == 1){
                return false;
            }else {
                $SalvarPedidodeAmizade = $pdo->prepare("insert into amizades values(null,?,?,0)");
                if ($SalvarPedidodeAmizade->execute(array($_SESSION['id'],$idPara))) {
                    return true;
                }
                
            }
            return true;
        }

        public static function existePedidoAmizade($idPara){
            $pdo = \RedeSocialCosplay\mySQL::conectar();

            $verificarAmizade = $pdo->prepare("select *from amizades where (enviou = ? and recebeu = ?) or (enviou = ? and recebeu = ?)");
            $verificarAmizade->execute(array($_SESSION['id'],$idPara,$idPara,$_SESSION['id'])) ;

            if ($verificarAmizade->rowCount() == 1){
                return false;
            }else {
                return true;   
            }
        }

        public static function getUsuario($id){
            $pdo = \RedeSocialCosplay\mySQL::conectar();

            $usuario = $pdo->prepare("select * from usuarios where id = ? ");
            $usuario->execute(array($id)) ;

            return $usuario->fetch();
        }

        public static function listarSolicitacoesAmizades(){
            $pdo = \RedeSocialCosplay\mySQL::conectar();

            $listarSolicitacoesAmizades = $pdo->prepare("select * from amizades where recebeu = ? and status = 0");
            $listarSolicitacoesAmizades->execute(array($_SESSION['id'])) ;

            return $listarSolicitacoesAmizades->fetchAll();
        }

        public static function atualizarStatusPedidoAmizade($quemEnviou,$status){
            $pdo = \RedeSocialCosplay\mySQL::conectar();
            if ($status == 0) {
                $deletarPedidoRecusado = $pdo->prepare("delete from amizades where enviou = ? and recebeu = ? and status = 0");  
                $deletarPedidoRecusado->execute(array($quemEnviou,$_SESSION['id']));
            } else if ($status == 1) {
                $aceitarPedido = $pdo->prepare("update amizades set status = 1 where enviou = ? and recebeu = ?");  
                $aceitarPedido->execute(array($quemEnviou,$_SESSION['id']));

                if ($aceitarPedido->rowCount() == 1) {
                    return true;
                } else {
                    return false;
                }
                
            }
        }


        public static function verificarSeAmizadeExiste($quemEnviou){
            $pdo = \RedeSocialCosplay\mySQL::conectar();
            $verificarSeAmizadeExiste = $pdo->prepare("select * from amizades where (enviou = ? and recebeu = ? and status = 1) or (enviou = ? and recebeu = ? and status = 1)");
            $verificarSeAmizadeExiste->execute(array($_SESSION['id'],$quemEnviou,$quemEnviou,$_SESSION['id'])) ;
            
            
            if ($verificarSeAmizadeExiste->rowCount() == 1){
                return true;
            }else {
                return false;   
            }
        } 

        public static function listarAmigos(){
            $pdo = \RedeSocialCosplay\mySQL::conectar();
            $listaDeAmigos = $pdo->prepare("select * from amizades where (enviou = ? and status = 1) or ( recebeu = ? and status = 1)");
            $listaDeAmigos->execute(array($_SESSION['id'],$_SESSION['id'])) ;
            
            $listaDeAmigos = $listaDeAmigos->fetchAll();
            $amigos = array();
            foreach ($listaDeAmigos as $key => $value) {
                if($value['enviou'] == $_SESSION['id']){
                    $amigos[] = $value['recebeu'];    
                }else {
                    $amigos[] = $value['enviou'];
                }  
            }

            $listaAmigosInformacoes = array();
            
            foreach ($amigos as $key => $value) {
                $listaAmigosInformacoes[$key]['nome'] = self::getUsuario($value)['nome']; 
                $listaAmigosInformacoes[$key]['email'] = self::getUsuario($value)['email']; 
                $listaAmigosInformacoes[$key]['img'] = self::getUsuario($value)['img']; 
                
                
            }

            return $listaAmigosInformacoes;
        } 
        public static function usuarioModerador(){
            $pdo = \RedeSocialCosplay\mySQL::conectar();
            $verificarSeUsusarioModerador = $pdo->prepare("select * from usuarios where id = ? and moderador = 1");
            $verificarSeUsusarioModerador->execute(array($_SESSION['id'])) ;
            
            
            if ($verificarSeUsusarioModerador->rowCount() == 1){
                return true;
            }else {
                return false;   
            }
        } 

    }

?>
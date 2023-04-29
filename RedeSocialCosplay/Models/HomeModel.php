<?php
    namespace RedeSocialCosplay\Models;

    class HomeModel{
        public static function postFeed($post,$imgPost){
			$pdo = \RedeSocialCosplay\mySQL::conectar();
			$post = strip_tags($post);
			if(preg_match('/\[imagem=/',$post)){
                
				$post = preg_replace('/(.*?)\[imagem=(.*?)\]/', '<p>$1</p><img src="$2" />', $post)	;
				
                echo $post ;
			}else{
				$post = '<p>'.$post.'</p>';
			}
				
		    if ($imgPost != ''){
                        $pdo = \RedeSocialCosplay\mySQL::conectar();
						$file = $_FILES['file'];
						$fileExt = explode('.',$file['name']);
						$fileExt = $fileExt[count($fileExt) - 1];
						if($fileExt == 'png' || $fileExt == 'jpg' ||$fileExt == 'jpeg'){
							//Formato válido.
							//Validar tamanho.
							$size = intval($file['size'] / 1024);
							if($size <= 400){
								$uniqid = uniqid().'.'.$fileExt;
								move_uploaded_file($file['tmp_name'],$uniqid);
							}else{
								\RedeSocialCosplay\Utilidades::alerta('Erro ao processar seu arquivo.');
								\RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);
							}
						}else{
							\RedeSocialCosplay\Utilidades::alerta('Erro ao processar seu arquivo.');
							\RedeSocialCosplay\Utilidades::redirect(INCLUDE_PATH);
						}
			}else{
			    $uniqid = '';    
			}	
			if(\RedeSocialCosplay\Models\UsuariosModel::usuarioModerador()){
				$postFeed = $pdo->prepare("INSERT INTO `posts` VALUES (null,?,?,?,1,?)");
			}
			else{	
				$postFeed = $pdo->prepare("INSERT INTO `posts` VALUES (null,?,?,?,0,?)");
			} 
			$postFeed->execute(array($_SESSION['id'],$post,date('Y-m-d H:i:s',time()),$uniqid));

			//$atualizaUsuario = $pdo->prepare("UPDATE usuarios SET ultimo_post = ? WHERE id = ?");
			//$atualizaUsuario->execute(array(date('Y-m-d H:i:s',time()),$_SESSION['id']));
			
		}

		public static function BuscarPostsFeed(){


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
				$listaAmigosInformacoes[$key]['id'] = \RedeSocialCosplay\Models\UsuariosModel::getUsuario($value)['id'];
                $listaAmigosInformacoes[$key]['nome'] = \RedeSocialCosplay\Models\UsuariosModel::getUsuario($value)['nome']; 
                $listaAmigosInformacoes[$key]['email'] = \RedeSocialCosplay\Models\UsuariosModel::getUsuario($value)['email']; 
                
            }

			$where = implode(',', array_fill(0, count($listaAmigosInformacoes) , ' posts.usuario_id = ?  '));
			$where = str_replace(',','or',$where);
			if ($where <>'') {
				$where = '(('.$where.') and (posts.status = 1)) or';
			}
			$poststeste = array();
			foreach ($listaAmigosInformacoes as $key => $value) {
				$poststeste[$key] = $value['id'];
			}
			$poststeste[] = $_SESSION['id'];
			$posts = [];
			$texto = "select posts.data, posts.post, usuarios.nome, posts.status,posts.id,posts.usuario_id,usuarios.img,posts.imgPost 
			from posts left join usuarios on posts.usuario_id = usuarios.id 
			where $where (posts.usuario_id = ?)  order by posts.data DESC";
			if (\RedeSocialCosplay\Models\UsuariosModel::usuarioModerador()){
				$texto = "select posts.data, posts.post, usuarios.nome, posts.status,posts.id,posts.usuario_id,usuarios.img,posts.imgPost  from posts left join usuarios on posts.usuario_id = usuarios.id order by posts.data DESC";
				$BuscarPostsBanco =  $pdo->prepare($texto);
			
				$BuscarPostsBanco->execute();
			}else{
				$BuscarPostsBanco =  $pdo->prepare($texto);
			
				$BuscarPostsBanco->execute($poststeste);
			}
			
			$BuscarPostsBanco = $BuscarPostsBanco->fetchAll();

			foreach ($BuscarPostsBanco as $key => $value) {
				$posts[$key]['usuario'] = $value['nome'];
				$posts[$key]['img'] = $value['img'];
				$posts[$key]['data'] = $value['data'];
				$posts[$key]['conteudo'] = $value['post'];
				$posts[$key]['status'] = $value['status'];
				$posts[$key]['id'] = $value['id'];	
				$posts[$key]['usuario_id'] = $value['usuario_id'];
				$posts[$key]['imgPost'] = $value['imgPost'];
			}			
			return $posts;


		}

		public static function habilitarPost($idPost){
			$pdo = \RedeSocialCosplay\mySQL::conectar();
			
				
			
				
			$habilitarPostFeed = $pdo->prepare("update posts set status = 1 where id = ?"); 
			$habilitarPostFeed->execute(array($idPost));

			//$atualizaUsuario = $pdo->prepare("UPDATE usuarios SET ultimo_post = ? WHERE id = ?");
			//$atualizaUsuario->execute(array(date('Y-m-d H:i:s',time()),$_SESSION['id']));
			
		}


    }

	




?>
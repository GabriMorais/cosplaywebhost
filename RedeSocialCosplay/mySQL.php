<?php
    namespace RedeSocialCosplay;
    class mySQL{
        private static $pdo;

		public static function conectar(){
		if(self::$pdo == null){
				try{
				self::$pdo = new \PDO('mysql:host=localhost;dbname=id20409171_cosplay','id20409171_cosplay123','Wsu=-5jw%lV5ICbj',array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				self::$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
				}catch(Exception $e){
					echo 'erro ao conectar';
					error_log($e->getMessage());
				}
			}

			return self::$pdo;
		}    
    }
?>

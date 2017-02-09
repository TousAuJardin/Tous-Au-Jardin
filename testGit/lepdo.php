<?php

class lepdo{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=bdd_jardin';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;
	private static $monPdoJardin=null;
        private static $monPdo;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
        try {
    	lepdo::$monPdo = new PDO(lepdo::$serveur.';'.lepdo::$bdd, lepdo::$user, lepdo::$mdp); 
		lepdo::$monPdo->query("SET CHARACTER SET utf8");
	
        } catch (Exception $e) {
            throw new Exception("Erreur Ã  la connexion \n" . $e->getMessage());
        }
        
        }


	public  static function getPdo(){
		if(lepdo::$monPdoJardin==null){
			lepdo::$monPdoJardin= new lepdo();
		}
		return lepdo::$monPdoJardin;  

                }
                
                
        // fonction permettant d'ajouter un utilisateur        
        public function add_user($email,$password)
        {
            try {
            
             // Ceci est un requete préparé afin d'éviter toutes injections SQL
            $req = lepdo::$monPdo->prepare("insert into users values(0,:email,:password)");
            
            $req->bindParam(':email', $email, PDO::PARAM_STR);
            $req->bindParam(':password', $password, PDO::PARAM_STR);
            $req->execute();
            }
            catch (Exception $e) {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
            }

        }
        
        
        public function getInfoUser($email)
        {
            
            $req= lepdo::$monPdo->prepare("select * from users where email=:email");
            
            $req->bindParam(':email', $email, PDO::PARAM_STR);
            $req->execute();
            
            $ligne = $req->fetch();
            return $ligne;
        }
}
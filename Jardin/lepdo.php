<?php


class lepdo{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=devto790346';   		
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
                
                
        /**
         * @todo fonction permettant de creer un user
         * @param type $email
         * @param type $password
         */        
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
        /**
         * @todo Ajout d'un loueur dans la table loueur
         * @author Firat
         * @param type $id_user
         * @param type $raison_sociale
         * @param type $numero_voie
         * @param type $type_voie
         * @param type $nom_voie
         * @param type $code_postal
         * @param type $ville
         * @param type $telephone
         */
        public function add_loueur($id_user,$raison_sociale, $numero_voie, $type_voie, $nom_voie, $code_postal, $ville, $telephone)
        {
            try {
            
             // Ceci est un requete préparé afin d'éviter toutes injections SQL
            $req = lepdo::$monPdo->prepare("insert into loueur values(0, :id_user, :raison_sociale, :numero_voie, :type_voie, :nom_voie, :code_postal, :ville, :telephone)");
            
            $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $req->bindParam(':raison_sociale', $raison_sociale, PDO::PARAM_STR);
            $req->bindParam(':numero_voie', $numero_voie, PDO::PARAM_INT);
            $req->bindParam(':type_voie', $type_voie, PDO::PARAM_STR);
            $req->bindParam(':nom_voie', $nom_voie, PDO::PARAM_STR);
            $req->bindParam(':code_postal', $code_postal, PDO::PARAM_INT);
            $req->bindParam(':ville', $ville, PDO::PARAM_STR);
            $req->bindParam(':telephone', $telephone, PDO::PARAM_INT);
            $req->execute();
            }
            catch (Exception $e) {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
            }

        }
        
        /**
         * @todo Ajout d'un jardinier
         * @param type $id_user
         * @param type $nom
         * @param type $prenom
         * @param type $numero_voie
         * @param type $type_voie
         * @param type $nom_voie
         * @param type $code_postal
         * @param type $ville
         * @param type $telephone
         */
        public function add_jardinier($id_user,$nom, $prenom, $numero_voie, $type_voie, $nom_voie, $code_postal, $ville, $telephone)
        {
            try {
            
             // Ceci est un requete préparé afin d'éviter toutes injections SQL
            $req = lepdo::$monPdo->prepare("insert into jardinier values(0, :id_user, :nom, :prenom, :numero_voie, :type_voie, :nom_voie, :code_postal, :ville, :telephone)");
            
            $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $req->bindParam(':nom', $raison_sociale, PDO::PARAM_STR);
            $req->bindParam(':prenom', $raison_sociale, PDO::PARAM_STR);
            $req->bindParam(':numero_voie', $numero_voie, PDO::PARAM_INT);
            $req->bindParam(':type_voie', $type_voie, PDO::PARAM_STR);
            $req->bindParam(':nom_voie', $nom_voie, PDO::PARAM_STR);
            $req->bindParam(':code_postal', $code_postal, PDO::PARAM_INT);
            $req->bindParam(':ville', $ville, PDO::PARAM_STR);
            $req->bindParam(':telephone', $telephone, PDO::PARAM_INT);
            $req->execute();
            }
            catch (Exception $e) {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
            }

        }
        
        /**
         * @todo Recupère les données d'un jardinier 
         * @param $id
         * @author Firat
         * @return Renvoie les données d'un compte Jardinier
         */
        public function getInfoJardinier($id)
        {
            
            $req= lepdo::$monPdo->prepare("select * from jardinier where id_user = :id");
            
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();
            
            $ligne = $req->fetch();
            return $ligne;
        }
        
        /**
         * @todo Recupère les données d'un Loueur
         * @param $id
         * @author Firat
         * @return Renvoie les données d'un compte LOUEUR
         */
        public function getInfoLoueur($id)
        {
            
            $req= lepdo::$monPdo->prepare("select * from loueur where id_user = :id");
            
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();
            
            $ligne = $req->fetch();
            return $ligne;
        }
        
        
        /**
         * @author Firat
         * @todo Retourne latitude et la longtitude de chaque terrain
         * @return type
         */
        public function getTerrains()
        {
            
            $req= lepdo::$monPdo->prepare("select longtiude, latitude from terrain");
            
            $req->execute();
            
            $ligne = $req->fetch();
            return $ligne;
        }
        /**
         * @todo Recupère les données d'un User
         * @param $email
         * @author Firat
         * @return Renvoie les données d'un Users
         */
        public function getInfoUser($email)
        {
            
            $req= lepdo::$monPdo->prepare("select * from users where email=:email");
            
            $req->bindParam(':email', $email, PDO::PARAM_STR);
            $req->execute();
            
            $ligne = $req->fetch();
            return $ligne;
        }
        
        /**
         * @todo Renvoie l'id max dans la table Users
         * @author Firat
         * 
         */
        public function getMaxId()
        {
            
            $req= lepdo::$monPdo->prepare("select max(id) from users");
            
            $req->execute();
            
            $ligne = $req->fetch();
            return $ligne;
        }
        /**
         * @todo Supprime le user
         * @author Firat 
         * @param type $id
         */
        public function delete_user($id)
        {
            
            $req = lepdo::$monPdo->prepare("delete from client where id=:id");
            
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();

        }
        /**
         * @todo Modifier les données d'un loueur
         * @author Firat
         * @param type $id_user
         */
        public function set_loueur($id_user)
        {
           $req= lepdo::$monPdo->prepare("update loueur set raison_sociale=:raison_sociale, 
           numero_voie=:numero_voie, 
           type_voie=:type_voie,
           nom_voie = :nom_voie,
           code_postal = :code_postal,
           ville=:ville,
           telephone = :telephone 
           where id_user=:id_user");

            $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $req->bindParam(':raison_sociale', $raison_sociale, PDO::PARAM_STR);
            $req->bindParam(':numero_voie', $numero_voie, PDO::PARAM_INT);
            $req->bindParam(':type_voie', $type_voie, PDO::PARAM_STR);
            $req->bindParam(':nom_voie', $nom_voie, PDO::PARAM_STR);
            $req->bindParam(':code_postal', $code_postal, PDO::PARAM_INT);
            $req->bindParam(':ville', $ville, PDO::PARAM_STR);
            $req->bindParam(':telephone', $telephone, PDO::PARAM_INT);
            
           
            $req->execute();
        }
        
        /**
         * @todo Modifie les données d'un Jardinier
         * @author Firat
         * @param type $id_user
         */
        public function set_jardinier($id_user)
        {
           $req= lepdo::$monPdo->prepare("update jardinier set nom=:nom,
           prenom = :prenom,
           numero_voie=:numero_voie, 
           type_voie=:type_voie,
           nom_voie = :nom_voie,
           code_postal = :code_postal,
           ville=:ville,
           telephone = :telephone 
           where id_user=:id_user");

            $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $req->bindParam(':nom', $raison_sociale, PDO::PARAM_STR);
            $req->bindParam(':prenom', $raison_sociale, PDO::PARAM_STR);
            $req->bindParam(':numero_voie', $numero_voie, PDO::PARAM_INT);
            $req->bindParam(':type_voie', $type_voie, PDO::PARAM_STR);
            $req->bindParam(':nom_voie', $nom_voie, PDO::PARAM_STR);
            $req->bindParam(':code_postal', $code_postal, PDO::PARAM_INT);
            $req->bindParam(':ville', $ville, PDO::PARAM_STR);
            $req->bindParam(':telephone', $telephone, PDO::PARAM_INT);
            
           
            $req->execute();
        }
}
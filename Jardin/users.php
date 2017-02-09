<?php
include("./pdo/lepdo.php");
session_start(); //On démarre une séssion

$action = $_REQUEST['action'];
$pdo = lepdo::getPdo();  // Création de l'objet $pdo pour se connecter à la BDD

switch ($action) {
    case 'add':

        // Récupération des valeurs envoyées par add_user.php
        $type_compte =  $_POST['type_compte'];
        $nom =  $_POST['nom'];
        $prenom =  $_POST['prenom'];
        $raison_sociale = $_POST['raison_sociale'];
        $email= $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        
        $numero_voie = $_POST['numero_voie'];
        $type_voie = $_POST['type_voie'];
        $nom_voie = $_POST['nom_voie'];
        $code_postal = $_POST['code_postal'];
        $ville = $_POST['ville'];
        $telephone = $_POST['telephone'];
        
        $infoUser = $pdo-> getInfoUser($email);
        
        $erreur = null;
       
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // vérifie si c'est une adresse email
        {
          $erreur = "Entrez une adresse mail valide"; 
        }
        else if(strlen($password1)<6) // verifie si le mot de passe a moins de 6 caractères
        {
            $erreur = " Veuillez entrer plus de 6 caractères pour le mot de passe";
        }
        else if ($password1 != $password2) // si les mots de passe sont différents
        {
          $erreur = " Les deux mots de passe sont différents ";
        }
        else if (empty($type_compte))
        {
            $erreur = " Veuillez entrer votre type de compte";
        }
        else if (empty($nom) && $type_compte == "jardinier")
        {
            $erreur = " Veuillez entrer votre nom";
        }
        else if (empty($raison_sociale) && $type_compte == "loueur")
        {
            $erreur = " Veuillez entrer votre raison sociale";
        }
        else if (empty($numero_voie))
        {
            $erreur = " Veuillez entrer le numéro de la voie";
        }
        else if (empty($type_voie))
        {
            $erreur = " Veuillez entrer le type de la voie";
        }
        else if (empty($nom_voie))
        {
            $erreur = " Veuillez entrer le nom de la voie";
        }
        else if (empty($code_postal))
        {
            $erreur = " Veuillez entrer le code postal";
        }
        else if (empty($ville))
        {
            $erreur = " Veuillez entrer la ville";
        }
        else if (empty($telephone))
        {
            $erreur = " Veuillez entrer le telephone";
        }
        else if ($infoUser!=null) // Si l'adresse email n'a pas été trouvée dans la BDD
        {
        	$erreur = "Adresse email existante";
        }
        else {
            
            $HashedPassword = password_hash($password1, PASSWORD_DEFAULT );  // Hash du mot de passe
            $pdo->add_user($email,$HashedPassword); // Insertion dans la BDD
            
            $idMax_array = $pdo->getMaxId();
            $idMax = $idMax_array[0];
            /*
            var_dump($type_compte);
            var_dump($idMax);
            var_dump($type_compte);
             
             */
            if ($type_compte == "loueur" )
            {
                try {
                        $pdo->add_loueur($idMax, $raison_sociale, $numero_voie, $type_voie, $nom_voie, $code_postal, $ville, $telephone);
                } 
                catch (Exception $e) {
                        throw new Exception("Erreur Ã  la connexion \n" . $e->getMessage());
                }
            }
            else if ($type_compte == "jardinier" )
            {
                try {
                        $pdo->add_jardinier($idMax, $nom, $prenom, $numero_voie, $type_voie, $nom_voie, $code_postal, $ville, $telephone);
                } 
                catch (Exception $e) {
                        throw new Exception("Erreur Ã  la connexion \n" . $e->getMessage());
                }
            }
            
            $_SESSION['email'] = $email;
            $_SESSION['type_compte'] = $type_compte;
            
         }
            
        if ($erreur != null)
        {
            include './add_user.php';
        }
        else {
            
            include './index.php';        
        }
        break;
        
    case 'delete':
     
     $password_delete = $_POST['password_delete'];
       
     $infoUser_delete = $pdo-> getInfoUser($_SESSION['email']);
     
     if (password_verify($password_delete, $infoUser_delete['password']) )
     {
        try {
            $pdo->delete_user($infoUser_delete['id']);
            $deleted = true;
        }
        catch (Exception $e) {
                    throw new Exception("Erreur Ã  la connexion \n" . $e->getMessage());
            }
         
     }
     include './index.php';
     break;
 
    case 'edit':
     $infoUser = $pdo-> getInfoUser($_SESSION['email']);
     
     $jardinier = $pdo-> getInfoJardinier($infoUser['id']);
     $loueur = $pdo-> getInfoLoueur($infoUser['id']);
        
     if($jardinier != null ) $_SESSION['type_compte'] = 'jardinier';
     else if ($loueur != null) $_SESSION['type_compte'] = 'loueur';   
        
     if( $_SESSION['type_compte'] = 'loueur') include './edit_user_loueur.php';
     else if( $_SESSION['type_compte'] = 'jardinier') include './edit_user_jardinier.php';

     
     break;
 
    case 'updatejardinier':
     
    $_jardinier_nom = $_POST['nom'];
    $_jardinier_prenom = $_POST['prenom'];
    $_jardinier_numero_voie = $_POST['numero_voie'];
    $_jardinier_type_voie = $_POST['type_voie'];
    $_jardinier_nom_voie = $_POST['nom_voie'];
    $_jardinier_code_postal = $_POST['code_postal'];
    $_jardinier_ville = $_POST['ville'];
    $_jardinier_telephone = $_POST['telephone'];
     
    
        if (empty($_jardinier_nom))
        {
            $erreur = " Veuillez entrer votre nom";
        }
        else if (empty($_jardinier_prenom))
        {
            $erreur = " Veuillez entrer vorre prenom";
        }
        else if (empty($_jardinier_numero_voie))
        {
            $erreur = " Veuillez entrer le numéro de la voie";
        }
        else if (empty($_jardinier_type_voie))
        {
            $erreur = " Veuillez entrer le type de la voie";
        }
        else if (empty($_jardinier_nom_voie))
        {
            $erreur = " Veuillez entrer le nom de la voie";
        }
        else if (empty($_jardinier_code_postal))
        {
            $erreur = " Veuillez entrer le code postal";
        }
        else if (empty($_jardinier_ville))
        {
            $erreur = " Veuillez entrer la ville";
        }
        else if (empty($_jardinier_telephone))
        {
            $erreur = " Veuillez entrer le telephone";
        }
        
         if ($erreur != null)
        {
            include './edit_user_jardinier.php';
        }
        else {
            
            include './index.php';        
        }
        
        
        
        
     break;
 
    case 'updateloueur':
     
    $_loueur_raison_sociale = $_POST['raison_sociale'];
    $_loueur_numero_voie = $_POST['numero_voie'];
    $_loueur_type_voie = $_POST['type_voie'];
    $_loueur_nom_voie = $_POST['nom_voie'];
    $_loueur_code_postal = $_POST['code_postal'];
    $_loueur_ville = $_POST['ville'];
    $_loueur_telephone = $_POST['telephone'];
     
    
    if (empty($_loueur_raison_sociale))
        {
            $erreur = " Veuillez entrer votre raison sociale";
        }
        else if (empty($_loueur_numero_voie))
        {
            $erreur = " Veuillez entrer le numéro de la voie";
        }
        else if (empty($_loueur_type_voie))
        {
            $erreur = " Veuillez entrer le type de la voie";
        }
        else if (empty($_loueur_nom_voie))
        {
            $erreur = " Veuillez entrer le nom de la voie";
        }
        else if (empty($_loueur_code_postal))
        {
            $erreur = " Veuillez entrer le code postal";
        }
        else if (empty($_loueur_ville))
        {
            $erreur = " Veuillez entrer la ville";
        }
        else if (empty($_loueur_telephone))
        {
            $erreur = " Veuillez entrer le telephone";
        }
        
         if ($erreur != null)
        {
            include './edit_user_loueur.php';
        }
        else {
            
            include './index.php';        
        }
     break;
 
    case 'deconnexion':
     session_unset(); //Remet les variables de session a Zero
     session_destroy(); // Detruit la session
     include './index.php';
     break;
 
    case 'connexion':
     
     $email= $_POST['email'];
     $password= $_POST['password'];
     
     // Mot de passe Hashé
    // $HashedPassword = password_hash($password, PASSWORD_DEFAULT );
    $infoUser = $pdo-> getInfoUser($email);
     
     // var_dump($infoUser);    //Pour voir le contenu de $infoUser
     // var_dump($infoUser['password']);
     // var_dump($HashedPassword);
     
     if ($infoUser!= null && password_verify($password, $infoUser['password']) )
     {
         
         $_SESSION['email'] = $email; 
               
         $jardinier = $pdo-> getInfoJardinier($infoUser['id']);
          $loueur = $pdo-> getInfoLoueur($infoUser['id']);
          
        if($jardinier != null )
        {
            $_SESSION['type_compte'] = 'jardinier'; 
            $type_compte="jardinier";
        }
        else if ($loueur != null)
        {
            $_SESSION['type_compte'] = 'loueur';   
            $type_compte="loueur";
        }
        
         if($type_compte=="loueur"){
             $loueur=$pdo->getInfoLoueur($infoUser['id']);
             $_SESSION['id_loueur']=$loueur['id_loueur'];
             include './index.php';
         }
         if($type_compte=="jardinier"){
             $jardinier=$pdo->getInfoJardinier($infoUser['id']);
             $_SESSION['id_jardinier']=$jardinier['id_jardinier'];
             include './gestion_jardinier.php';
         }
         
          

         
         
     }
     else {
         $erreur= "Données incorrectes";
          include './index.php';
          
     }
     
     break;
}
?>
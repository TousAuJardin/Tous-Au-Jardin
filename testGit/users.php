<?php
include("lepdo.php");


$action = $_REQUEST['action'];
$pdo = lepdo::getPdo();

switch ($action) {
    case 'add':


        // Récupération des valeurs envoyées par navbar.php
        
        $email= $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        
        $erreur = null;
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // vérifie si c'est une adresse email
        {
          $erreur = "Entrez une adresse mail valide"; 
        }
        else if ($password1 != $password2) // si les mots de passe sont différents
        {
          $erreur = " Les deux mots de passe sont différents ";
        }
        else {
            $HashedPassword = password_hash($password1, PASSWORD_DEFAULT );  // Hash du mot de passe
            $pdo->add_user($email,$HashedPassword); // Insertion dans la BDD
            session_start(); //On démarre une séssion 
            $_SESSION['email'] = $email; 
            $connexion_ok = true;
            include './index.php';
            
        }
        break;
        
    case 'deconnexion':
        
     session_destroy();
     include './index.php';
     break;
 
    case 'connexion':
     
     $email= $_POST['email'];
     $password= $_POST['password'];
     
     $HashedPassword = password_hash($password, PASSWORD_DEFAULT );
     $infoUser = $pdo-> getInfoUser($email);
    
     
     // var_dump($infoUser);    Pour voir le contenu de $infoUser
     // var_dump($infoUser['password']);
     // var_dump($HashedPassword);
     
     if ($infoUser!= null && $HashedPassword == $infoUser['password'])
     {
         session_start(); //On démarre une séssion 
         $_SESSION['email'] = $email; 
         $connexion_ok = true;
         include './index.php';
     }
     else {
         
         
         
         $erreur=true;
          include './index.php';
          
     }
     
     break;
}
?>
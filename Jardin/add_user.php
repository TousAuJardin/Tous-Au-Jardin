<!DOCTYPE html>
<script language="javascript">

function AfficheLoueur()
{
    document.getElementById("div_row").style.display ="block";
    

    document.getElementById("form_raison_sociale").style.display ='block';
    document.getElementById("form_nom").style.display ="none";
    document.getElementById("form_prenom").style.display ="none";
    
   
    
}
function AfficheJardinier()
{
    document.getElementById("div_row").style.display ="block";
    document.getElementById("form_nom").style.display ="block";
    document.getElementById("form_prenom").style.display ="block";   
    document.getElementById("form_raison_sociale").style.display ="none";
}
 
</script>


<html lang="fr">

    <?php include('./partials/head.html'); ?>

<body>
    >
    <?php include('./partials/navbar.php'); ?>
   
        
    <div class="intro-header">
       
     
        <div class="container-fluid">
<div class="panel panel-success margin-top-50"> 
      <div class="panel-heading">
    <h3 class="panel-title">Inscription</h3>
  </div>
  <div class="panel-body color-darkgreen">
       <?php
          if (isset($erreur)) echo "<p class='bg-danger'> $erreur </p>";
          // les guillements lisent le PHP contrairement aux apostrophes.
          ?>
          
    
     <form method="POST" action="users.php?action=add" >
        <!-- Création des boutons radios -->
        <center>
       
       <label class="radio-inline">
           <input type="radio" name="type_compte" id="loueur" onclick="AfficheLoueur()" value="loueur"> Loueur (Entreprise, Mairie, Particulier)
        </label>
        <label class="radio-inline">
            <input type="radio" name="type_compte" id="jardinier" onclick="AfficheJardinier()" value="jardinier"> Jardinier
        </label>
          <!-- Création du formulaire -->
        </center>
          <div class="row display-none" id="div_row" >
  <div class="col-md-6">
  
      
            <div class="form-group display-none " id="form_nom">
                <label for="nom">Nom </label>
                <input type="text" class="form-control input-sm " <?php if(isset($erreur)) echo"value=$nom" ?> id="nom" name="nom" placeholder="AKTAS">
          </div>
      <div class="form-group display-none" id="form_prenom">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control input-sm" <?php if(isset($erreur)) echo"value=$prenom" ?>id="prenom"  name="prenom" placeholder="Firat">
          </div>
      <div class="form-group display-none" id="form_raison_sociale">
            <label for="raison_sociale">Raison sociale</label>
            <input type="text" class="form-control input-sm" <?php if(isset($erreur)) echo"value=$raison_sociale" ?> id="raison_sociale" name="raison_sociale" placeholder="Tous au Jardin">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" <?php if(isset($erreur)) echo"value=$email" ?> id="email" name="email" placeholder="jardin@tousaujardin.fr">
          </div>
          <div class="form-group">
            <label for="password1">Mot de passe</label>
            <input type="password" class="form-control" id="password1" name="password1" placeholder="xxxxxxx">
          </div>
              
          <div class="form-group">
            <label for="password2">Confirmez votre mot de passe</label>
            <input type="password" class="form-control" id="password2" name="password2" placeholder="xxxxxxx">
          </div>
      
      <center><button type="submit" class="btn btn-success">Créer votre compte</button>
          </center></div>
  
              
              
  <div class="col-md-6">
          
         
          <div class="form-group">
            <label for="numero_voie">Numéro voie</label>
            <input type="number" class="form-control input-sm" <?php if(isset($erreur)) echo"value=$numero_voie" ?> id="numero_voie" name="numero_voie" placeholder="1">
          </div>
          <div class="form-group">
            <label for="type_voie">Type voie</label>
            <input type="text" class="form-control input-sm" <?php if(isset($erreur)) echo"value=$type_voie" ?> id="type_voie" name="type_voie" placeholder="bis chemin">
          </div>
          <div class="form-group">
            <label for="nom_voie">Nom voie</label>
            <input type="text" class="form-control input-sm" <?php if(isset($erreur)) echo"value=$nom_voie" ?> id="nom_voie" name="nom_voie" placeholder="des broutières">
          </div>
          <div class="form-group">
            <label for="code_postal">Code postal</label>
            <input type="number" class="form-control input-sm"  <?php if(isset($erreur)) echo"value=$code_postal" ?>id="code_postal" name="code_postal" placeholder="13015">
          </div>
          <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control input-sm" <?php if(isset($erreur)) echo"value=$ville" ?> id="ville" name="ville" placeholder="Marseille">
          </div>
          <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control input-sm" <?php if(isset($erreur)) echo"value=$telephone" ?> id="telephone" name="telephone" placeholder="06 60 87 XX XX">
          </div>
  
    </div>      
    </div>      
</form>
      </div>
      </div>
        </div> 
        </div>
    
</html>
      
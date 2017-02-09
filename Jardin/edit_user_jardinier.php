<!DOCTYPE html>


<html lang="fr">

    <?php include('./partials/head.html'); ?>

<body>
    >
    <?php include('./partials/navbar.php'); ?>
   
        
    <div class="intro-header">
       
     
        <div class="container-fluid">
<div class="panel panel-success margin-top-50"> 
      <div class="panel-heading">
    <h3 class="panel-title">Modification des données</h3>
  </div>
  <div class="panel-body color-darkgreen">
       <?php
          if (isset($erreur)) echo "<p class='bg-danger'> $erreur </p>";
          // les guillements lisent le PHP contrairement aux apostrophes.
          ?>
          
    
     <form method="POST" action="users.php?action=updatejardinier" >
      
          <div class="row" id="div_row" >
  <div class="col-md-6">
  
      
            <div class="form-group " id="form_nom">
                <label for="nom">Nom </label>
                <input type="text" class="form-control input-sm " <?php echo'value="'.$jardinier['nom'].' " '; ?>id="nom" name="nom" placeholder="AKTAS">
          </div>
      <div class="form-group " id="form_prenom">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control input-sm" <?php echo'value="'.$jardinier['prenom'].' " '; ?> id="prenom"  name="prenom" placeholder="Firat">
          </div>
      
      <center><button type="submit" class="btn btn-success">Modifier</button>
          </center></div>
  
              
              
  <div class="col-md-6">
          
         
          <div class="form-group">
            <label for="numero_voie">Numéro voie</label>
            <input type="number" class="form-control input-sm" <?php
            echo'value="'.$jardinier['numero_voie'].' " '; ?> id="numero_voie" name="numero_voie" placeholder="1">
          </div>
          <div class="form-group">
            <label for="type_voie">Type voie</label>
            <input type="text" class="form-control input-sm" <?php echo'value="'.$jardinier['type_voie'].' " '; ?> id="type_voie" name="type_voie" placeholder="bis chemin">
          </div>
          <div class="form-group">
            <label for="nom_voie">Nom voie</label>
            <input type="text" class="form-control input-sm" <?php echo'value="'.$jardinier['nom_voie'].' " '; ?> id="nom_voie" name="nom_voie" placeholder="des broutières">
          </div>
          <div class="form-group">
            <label for="code_postal">Code postal</label>
            <input type="number" class="form-control input-sm"  <?php echo'value="'.$jardinier['code_postal'].' " '; ?>id="code_postal" name="code_postal" placeholder="13015">
          </div>
          <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control input-sm" <?php echo'value="'.$jardinier['ville'].' " '; ?>id="ville" name="ville" placeholder="Marseille">
          </div>
          <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control input-sm" <?php echo'value="'.$jardinier['telephone'].' " '; ?>id="telephone" name="telephone" placeholder="06 60 87 XX XX">
          </div>
  
    </div>      
    </div>      
</form>
      </div>
      </div>
        </div> 
        </div>
    
</html>
      
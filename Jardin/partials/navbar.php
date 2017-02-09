<?php

if(isset($erreur)) // SI il y a une erreur afficher la fenetre connexion 
{
    ?>
<script>
    $( document ).ready(function() 
    {
        $('#ModalConnexion').modal('show')
        });
</script>
    <?php
}

?>


    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav " role="navigation">
        <div class="container topnav">
                <a class="navbar-brand topnav" href="#">Tous au Jardin !</a>
                
                 <!-- Affiche une menu déroulant pour les mobiles -->
                    <div class="navbar-header ">

                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>

                    </div>
                
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#about">Mentions Légales</a>
                    </li>
                    <li>
                        <?php
                        if (!isset($_SESSION['email']))
                        {
                            ?>  <a  data-toggle="modal" data-target="#ModalConnexion" >Connexion</a> <?php  
                        }
                        else
                        {
                            ?>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <b><i> <center><?php echo $_SESSION['email']; ?> </center></i></b>
                            </li>
                            <li>
                                <a href="./users.php?action=edit" >Modifier mes coordonnées</a>
                            </li>
                            <li>
                                <a data-toggle="modal" data-target="#ModalSuppression" >Supprimer mon compte</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a class="btn btn-danger"  data-toggle="modal" data-target="#ModalDeconnexion"> 
                                    <span class="glyphicon glyphicon-off" class="btn btn-primary" aria-hidden="true"></span>
                                </a> 
                            </li>
                        </ul>
                    </li>
                    <?php
                        }
                        ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    <!-- Button trigger modal -->


<!-- Modal Connexion -->

<form method="POST" action="users.php?action=connexion"> 
 <div class="modal fade" id="ModalConnexion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Connexion</h4>
      </div>
      <div class="modal-body">
          <?php
          if (isset($erreur)) echo "<p class='bg-danger'> $erreur </p>";
          // les guillements lisent le PHP contrairement aux apostrophes.
          ?>
          
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            
            <input type="email" class="form-control" id="exampleInputEmail1" <?php if(isset($email))
                {  ?> value="<?php echo $email ?>"  <?php  }  ?>
                name="email" placeholder="jardin@tousaujardin.fr">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword">Mot de passe</label>
            <input type="password" class="form-control" id="exampleInputPassword" name="password" placeholder="xxxxxxx">
          </div>
      </div>
        
        
      <div class="modal-footer">
          <div class="btn_creer_compte">
             <!-- 
              <button type="button" class="btn btn-info " data-toggle="modal" data-dismiss="modal" data-target="#myModalConnexion"  >Créer un compte</button>
             -->
             <a href="./add_user.php"><button type="button" class="btn btn-info "  >Créer un compte</button></a>
             </div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-success">Se connecter</button>
      </div>
    </div>
  </div>
</div>
</form>


<!-- Modal Déconnexion -->
<div class="modal fade" id="ModalDeconnexion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Connexion</h4>
      </div>
      <div class="modal-body">
          Êtes-vous sûr de vouloir vous déconnecter ?
      </div>
        
        
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <a href="users.php?action=deconnexion"><button type="button" class="btn btn-success"> Se Déconnecter</button></a>
      </div>
    </div>
  </div>
</div>

<!-- Modal Suppression -->
<div class="modal fade" id="ModalSuppression" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Suppresion</h4>
      </div>
      <div class="modal-body">
          Êtes-vous sûr de vouloir supprimer votre compte ?
         
          <div class="form-group">
            <label for="password_delete">  <br> Si oui, entrez votre mot de passe</label>
            <input type="password" class="form-control" id="password_delete" name="password_delete" placeholder="xxxxxxx">
          </div>
          
      </div>
        
        
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <a href="users.php?action=delete"><button type="button" class="btn btn-danger"> Supprimer</button></a>
      </div>
    </div>
  </div>
</div>



<!-- Modal Créer Compte
 <form method="POST" action="users.php?action=add">
     <div class="content-modal">
     <div class="modal fade" id="myModalConnexion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="position: relative;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Créer un compte</h4>
      </div>
      <div class="modal-body">
         
        <center>
        <!-- Création des checkbox 
        <label class="radio-inline">
            <input type="radio" name="type_compte" id="loueur" value="loueur"> Loueur (Entreprise, Mairie, Particulier)
        </label>
        <label class="radio-inline">
            <input type="radio" name="type_compte" id="jardinier" value="jardinier"> Jardinier
        </label>
        </center>
          
          <!-- Création du formulaire 
          
          
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="jardin@tousaujardin.fr">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password1" placeholder="xxxxxxx">
          </div>
              
          <div class="form-group">
            <label for="exampleInputPassword2">Confirmez votre mot de passe</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password2" placeholder="xxxxxxx">
          </div>
          
          <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="AKTAS">
          </div>
          <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Firat">
          </div>
          <div class="form-group">
            <label for="numero_voie">Numéro voie</label>
            <input type="number" class="form-control" id="numero_voie" name="numero_voie" placeholder="1">
          </div>
          <div class="form-group">
            <label for="type_voie">Type voie</label>
            <input type="text" class="form-control" id="type_voie" name="type_voie" placeholder="bis chemin">
          </div>
          <div class="form-group">
            <label for="nom_voie">Nom voie</label>
            <input type="text" class="form-control" id="nom_voie" name="nom_voie" placeholder="des broutières">
          </div>
          <div class="form-group">
            <label for="code_postal">Code postal</label>
            <input type="number" class="form-control" id="code_postal" name="code_postal" placeholder="13015">
          </div>
          <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" placeholder="Marseille">
          </div>
          <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="06 60 87 XX XX">
          </div>
      </div>
        
        
        
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-success">Créer votre compte</button>
      </div>
    </div>
  </div>
</div>
</div>
</form>  
          -->
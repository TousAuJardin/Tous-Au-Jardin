<?php

if(isset($erreur))
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
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#about">Mentions Légales</a>
                    </li>
                    <li>
                        <?php
                        if (isset($_SESSION['email']))
                        {
                            ?>  <a  data-toggle="modal" data-target="#ModalDeconnexion" >Déconnexion</a> <?php  
                        }
                        else
                        {
                            ?><a  data-toggle="modal" data-target="#ModalConnexion" >Connexion</a> <?php
                        }
                        ?>
                    </li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    <!-- Button trigger modal -->


<!-- Modal Connexion -->

<form method="POST" action="users.php?action=connexion"> 
    <?php
    if(isset($erreur))
    {
       ?> <div class="modal fade" id="ModalConnexion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-show="true"> <?php
    }
    else
    {
        ?> <div class="modal fade" id="ModalConnexion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><?php
    }
    ?>
    

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Connexion</h4>
      </div>
      <div class="modal-body">
          <?php
          if (isset($erreur)) echo '<p class="bg-danger">Données Incorrectes</p>';
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
              <button type="button" class="btn btn-info " data-toggle="modal" data-dismiss="modal" data-target="#myModalConnexion"  >Créer un compte</button>
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



<!-- Modal Créer Compte-->
 <form method="POST" action="users.php?action=add">
<div class="modal fade" id="myModalConnexion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Créer un compte</h4>
      </div>
      <div class="modal-body">
         
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
      </div>
        
        
        
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-success">Créer votre compte</button>
      </div>
    </div>
  </div>
</div>
 </form>
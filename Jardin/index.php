<!DOCTYPE html>
<html lang="fr">

    <?php 
    include('./partials/head.html');
    ?>
  
<body>
    
    <?php include('./partials/navbar.php');
     if(isset($_SESSION['email']))
     {
      ?>
        <div class="alert alert-info afficher_compte_cree" >
        <strong>Connexion réussie !</strong> Bienvenue parmi nous ! 
        </div> 
      <?php
      
      }
     if(isset($deleted) && $deleted == true)
     {
      ?>
        <div class="alert alert-warning afficher_compte_cree" >
        <strong>Compte supprimé</strong> A bientôt !
        </div> 
      <?php
      $deleted = false;
      }
      ?>
    
    
    
    
    <!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
    <div class="center">
        <div class="container">
    
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Tous au jardin !</h1>
                        <h3>Réserver </h3>
                        <hr class="intro-divider">
                        
                        <form class="form-inline" method="POST" action="carte_jardin.php" >
                            <div class="form-group">
                              <div class="input-group">
                                <input type="text" class="form-control" id="ville" placeholder="Lieux">
                                <div class="input-group-addon"> 
                                    <span class="glyphicon glyphicon-globe" aria-hidden="true"></span></div>
                              </div>
                            </div>
                             <button type="submit" class="btn btn-success" >Cherchez</button>
                          </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    </div>
    <!-- /.intro-header -->


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/jquery-ui.min.js"></script>
 <script>
  $(function() {
    $( "#ville" ).autocomplete({
      source: 'pdo/search.php'
    });
  });
  </script>

</body>

</html>

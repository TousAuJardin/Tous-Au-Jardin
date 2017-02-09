<!DOCTYPE html>
<html lang="fr">

    <?php include('./head.html'); ?>

<body>
    
    <?php include('./navbar.php');
     if(isset($connexion_ok))
     {
      ?>
        <div class="alert alert-info afficher_compte_cree" >
        <strong>Connexion réussie !</strong> Bienvenue parmi nous ! 
        </div> 
      <?php
      $connexion_ok = false;
      }
      ?>
    
    
    
    
    <!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Tous au jardin !</h1>
                        <h3>Réserver </h3>
                        <hr class="intro-divider">
                        
                        <form class="form-inline">
                            <div class="form-group">
                              <div class="input-group">
                                <input type="text" class="form-control" id="exampleInputAmount" placeholder="Lieux">
                                <div class="input-group-addon"> 
                                    <span class="glyphicon glyphicon-globe" aria-hidden="true"></span></div>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-success">Cherchez</button>
                          </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->

   

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

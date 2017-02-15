<?php
//session_start();
$id_jardinier=$_SESSION['id_jardinier'];
require 'pdo/ConnexionPDObis.class.php';
require 'pdo/News.class.php';
require 'pdo/NewsManagerPDO.class.php';
$db = ConnexionPDObis::getMysqlConnexionWithPDO();
$manager = new NewsManagerPDO($db);

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Espace jardinier</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <style>
            #myTab{
                margin-top: 50px;
            }
        </style>

    </head>

    <body>
        <?php include('./partials/navbar.php'); ?>

        <div class="container">
            <br />
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#liste_terrain">Mes terrains</a></li>
                <li><a data-toggle="tab" href="#menu1">Publications</a></li>
                <li><a data-toggle="tab" href="#menu2">Liste des terrains</a></li>
                <li><a data-toggle="tab" href="#calendrier">Calendrier</a></li>
            </ul>

            <div class="tab-content">
                <div id="liste_terrain" class="tab-pane fade in active">
                    <h3>Mes terrains</h3>
                    <?php include('liste_terrain.php'); ?>
                </div>
                <div id="calendrier" class="tab-pane">
                    <?php include('calendrier.php'); ?>
                </div>
                <div id="Publications" class="tab-pane fade">
                    <h3>Publications</h3>

                </div>
                <div id="Liste_des_terrains" class="tab-pane fade">
                    <h3>Liste des terrains</h3>
                    <?php include('Listeterrains.php'); ?>

                </div>
            </div>
        </div>
    </body>
</html>

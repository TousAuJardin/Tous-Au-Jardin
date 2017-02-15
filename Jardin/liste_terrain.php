<?php //session_start(); //On démarre une séssion ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .media-list{padding: 10px;}
        .miniature_terrain{border: 1px solid grey;}
    </style>
</head>

<body>
    <?php
    include_once("./pdo/lepdo.php");
    //$id_jardinier=$_SESSION('id_jardinier');
    //$id_jardinier=1;
    $pdo = lepdo::getPdo();

    $lesOccupations=$pdo->chercherLesOccupations($id_jardinier);
    if($lesOccupations==''){ //si le jardinier n'occupe pas de terrain
        $flag=false;
    }
    else{
        $flag=true;
        $lesOccupations=$pdo->chercherLesOccupations($id_jardinier);
    }
    if($flag){
        foreach ($lesOccupations as $uneOccupation){
            $unTerrain=$pdo->getInfoTerrain($uneOccupation);
            $Terrains[]=$unTerrain;
        } ?>
        <div>
        <?php foreach($Terrains as $unTerrain){ ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="<?php echo "terrain.php?id_terrain=".$unTerrain['id_terrain']."" ?>"><h3 class="panel-title"><?php echo $unTerrain['nom_terrain']; ?></h3></a>
                </div>
                <ul class="media-list">
                    <li class="media">
                        <div class="media-left "> 
                            <img class="miniature_terrain" src="img/terrain/terrain_1_1.jpg" height="150" width="230">
                        </div>
                        <div class="media-body">
                            <?php echo $unTerrain['description_terrain']; ?>
                        </div>
                    </li>
                </ul>
            </div>
        <?php } ?>
        </div>
    <?php } 
    else{
    ?>
        <p>Vous n'avez pas encore de terrain</p>
        <a href="#"><button type="button" class="btn btn-primary">Rechercher un terrain</button></a>
    <?php } ?>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) ->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed ->
    <script src="js/bootstrap.min.js"></script> -->
</body>
<head>
    <link href="css/fullcalendar.min.css" rel="stylesheet" />
    <link href="css/jquery-ui.min.css" rel="stylesheet" />
    <link href="css/jquery-ui.theme.css" rel="stylesheet" />
    
    <?php
    include_once('./pdo/lepdo.php');
    //$id_jardinier=$_SESSION['id_jardinier'];
    //$id_jardinier=1; //a enlever et remettre en haut
    $pdo = lepdo::getPdo();

    $lesOccupations=$pdo->chercherLesOccupations($id_jardinier);
    if($lesOccupations==''){ //si le jardinier n'occupe pas de terrain
        $flag=false;
    }
    else{
        $flag=true;
        foreach($lesOccupations as $uneOccupation){
            $lesEvenements[$uneOccupation]=$pdo->chercherLesEvenements($uneOccupation);
        }
    }
    if($flag==false){  //le jardinier n'occupe aucun terrain, il ne possède donc aucun évènement
        $events='';
    }
    else{
        foreach($lesEvenements as $lesArrayDEvenement){
            foreach($lesArrayDEvenement as $unEvenement){
                unset($evenement);
                $event['titre']=$unEvenement['titre'];
                $event['description']=$unEvenement['description'];
                $event['date']=$unEvenement['date'];
                $event['nom_terrain']=$unEvenement['nom_terrain'];
                $events[]=$event;
            }
        }
    }
    ?>

    <script>
        var events_js=<?php echo json_encode($events); ?>;
        var events = [];
        $(events_js).each(function(){
            events.push({
                title: $(this).attr('titre'),
                start: $(this).attr('date'),
                description: $(this).attr('description'),
                nom_terrain: $(this).attr('nom_terrain')
            });
        });

        $(document).ready(function(){
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) { //pour afficher le calendrier dans un tab 1/2
                $('#calendar').fullCalendar({
                    theme: true,
                    windowResize: true,
                    header:{
                        left: 'prev',
                        center: 'title',
                        right: 'next'
                    },
                    eventMouseover: function (event, jsEvent, view) {
                        if (view.name === 'month') {
                            $(jsEvent.target).attr('title', event.title);
                        }
                    },
                    editable: false,
                    eventLimit: true,
                    events:events,
                    timeFormat: 'H:mm',
                    eventClick: function(event){
                        /*$( "#dialog" ).empty();
                        $( "#dialog" ).append("<p>"+event.description+"</p>"+"<p align='right'>"+event.nom_terrain+"</p>");
                        $( "#dialog" ).dialog({
                            title: event.title,
                            width: 417,
                            position: { my: "left top", at: "left bottom", of: calendar },
                            draggable: false,
                            resizable: false,
                        });*/
                        document.getElementById("evenement").innerHTML = "<h3>"+event.title+"</h3>"+"<p>"+event.description+"</p>"+"<p><strong>"+event.nom_terrain+"</strong></p>";
                    }
                });
            });
            $('#myTab a:first').tab('show'); //pour afficher le calendrier dans un tab 2/2
        });
 
    </script>

    <style>
        #main{
            width:100%;
        }
        #calendar {
            max-width: 500px;
            margin-top: 25px;
            margin-right: 25px;
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            font-size: 12px;
            height:auto;
            width:auto;
            float:left;
        }
        #evenement{
            max-width: 500px;
            height:auto;
            width:auto;
            float:left;
            margin-top: 50px;
        }
        .ui-button .ui-icon {
            background-image: url(img/ui-icons_3d80b3_256x240.png);
        }     
    </style>         
</head>

<body>
    <div id="main">
        <div id="calendar"></div>
        <div id="evenement"></div>
    </div> 
    
    <!-- Nécessaire pour Fullcalendar-->
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>
    <script src='js/fr.js'></script>
    
    <!-- <script src='js/jquery.min.js'></script> -->
    <script src='js/jquery-ui.min.js'></script>
</body>
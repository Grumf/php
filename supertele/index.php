<?php

$db = new PDO('mysql:host=localhost;dbname=supertele',
                'root',
                '',
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=".\assets\css\bootstrap.min.css">
    <link rel="stylesheet" href=".\assets\css\styles.css">
    <title>SuperTélé</title>
</head>
<body>
    <header class="navbar navbar-inverse">
        <a class="navbar-brand" href="#">
            SuperTélé /S\
        </a>
    <p class="navbar-text navbar-right">Signed in as <a href="#" class="navbar-link">Mark Otto</a></p></header>
    <div class="container">

    <?php

    $prog = $db->query("SELECT date_diff FROM programme GROUP BY date_diff ORDER BY date_diff DESC");
    $progs = $prog->fetch(PDO::FETCH_ASSOC);
    $contenu="";
        while( $progs<6 ){
        $contenu.='<div class="row">
                    <h2>Soirée du '.$progs['date_diff'].'</h2>
                    <hr>';

        
            for( $i = 0; $i<=3; $i++){

                $prog = $db->query("SELECT * FROM programme");
                
                $contenu.= '<div class="col-md-4">
                                <div class="thumbnail">
                                    <img src="..." alt="...">
                                    <div class="caption">
                                        <h3>Thumbnail label</h3>
                                        <p>...</p>
                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                    </div>
                                </div>
                            </div>';
            }
        $contenu.="</div>";
                
        }
    echo $contenu; 
    
    ?>  
 <!-- while -->

           <!--  <div class="col-md-4">
                <div class="thumbnail">
                    <img src="..." alt="...">
                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                </div>
            </div><div class="col-md-4">
                <div class="thumbnail">
                    <img src="..." alt="...">
                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                </div>
            </div> -->
        
    </div>
    <footer class="navbar-fixed-bottom"><p class="text-right"> &copy; Copyright 2018 - SuperTélé - Tous droits réservés</p></footer>

    <script src="./assets\js\jquery-3.3.1.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
</body>
</html>
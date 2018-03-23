<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Liens css -->
    <link rel="stylesheet" href="<?= RACINE_SITE.'assets/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= RACINE_SITE.'assets/css/style.css' ?>">
    <title>SuperFringues</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapse" data-toggle="collapse" data-target="#monmenu">
                        <span class="sr-only">Naviguer</span>
                        <span class="glyphicon glyphicon-menu-hamburger"></span> 
                    </button>
                    <a href="<?= RACINE_SITE ?>" class="navbar-brand">SuperFringues</a>
                </div>
                <div class="collapse navbar-collapse" id="monmenu">
                    <ul class="nav navbar-nav">
                        <?php

                if(estConnecteEtAdmin() ){
                    
                    echo '<li><a href="'.RACINE_SITE.'admin/gestion_boutique.php">Gestion Boutique</a></li>';
                    echo '<li><a href="'.RACINE_SITE.'admin/gestion_membre.php">Gestion membre</a></li>';
                    echo '<li><a href="'.RACINE_SITE.'admin/gestion_commandes.php">Gestion Commandes</a></li>';
                }
                if ( estConnecte() ){

                    echo '<li><a href="'.RACINE_SITE.'profil.php">Profil</a></li>';
                    echo '<li><a href="'.RACINE_SITE.'connexion.php?action=deconnexion">Déconnexion</a></li>';
                }
                else {

                    echo '<li><a href="'.RACINE_SITE.'inscription.php">Inscription</a></li>';
                    echo '<li><a href="'.RACINE_SITE.'connexion.php">Connexion</a></li>';
                
                }

                echo '<li><a href="'.RACINE_SITE.'panier.php">Panier '.nbArticlePanier().'</a></li>';
                

                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container main">
  
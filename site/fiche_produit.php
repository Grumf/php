<?php

require_once('assets/init.php');
require_once('assets/haut.php');
$aside ='';

// controler l'existence du produit demandé
if ( isset($_GET['id_produit'])){
    $resul = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array('id_produit'=> $_GET['id_produit']));
    if ( $resul->rowCount() == 0){
        header('location:index.php');
        exit();
    }
    // Si j'arrive ici, c'est que j'ai un produit en base
    // 2 - affichage et mise en forme de la fiche produit
    $produit = $resul->fetch(PDO::FETCH_ASSOC);

    $contenu.='<div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">'.$produit['titre'].'</h1>
                </div>
            </div>';

    $contenu.='<div class="col-md-8">
                    <img src="'.$produit['photo'].'" alt="" class="img-responsive">
                </div>';

    $contenu.='<div class="col-md-4">
                <h3>Description</h3>
                <p>'.$produit['description'].'</p>
                <h3>Détails</h3>
                <ul>
                    <li>Catégorie : '.$produit['categorie'].'</li>
                    <li>Couleur : '.$produit['couleur'].'</li>
                    <li>Taille : '.$produit['taille'].'</li>
                </ul>
                <p class="lead">Prix : '.$produit['prix'].' €</p>
            </div>';

    // Gérer l'affichage de l'ajout au panier

    if ($produit['stock'] > 0 ){

        $contenu.='<div class="col-md-4">
                    <form method="post" action="panier.php">
                        <input type="hidden" name="id_produit" value='.$produit['id_produit'].'>
                        <select name="quantite" class="form-group-sm form-control-static">';

                        // Pour les quantité, on fixe un maximum à 5 en fonction du stock disponible
                        for ( $i=1; $i<=$produit['stock'] && $i <= 5; $i++){
                            $contenu.='<option>'.$i.'</option>';
                        }
        $contenu.=      '</select>
                        <input type="submit" name="ajout_panier" value="Ajouter au panier" class="btn btn-primary">
                    </form>
                </div>';
    }
    else {

        $contenu.='<div class="col-md-4">
                    <p>Produit indisponible.</p>
                </div>';
    }

    // Lien de retour à la boutique (en pré sélectionnant la catégorie du produit consulté)
    $contenu.='<div class="col-md-4">
                    <p>
                        <a href="index.php?categorie='.$produit['categorie'].'">Produit de même catégorie</a>
                    </p>
                </div>';

    // Construction de la variable $aside

    $resul = executeRequete("SELECT * FROM produit WHERE id_produit != :id_produit AND categorie = :categorie ORDER BY RAND() LIMIT 0,2", array('categorie'=> $produit['categorie'],
                                 'id_produit'=> $produit['id_produit']));

    while ( $suggestion = $resul->fetch(PDO::FETCH_ASSOC) ){ // tant qu'il y a des produit qui                                                                      répondent à la requête
        $aside.='<div class="col-sm-3">
                    <div class="thumbnail">
                        <a href="?id_produit='.$suggestion['id_produit'].'">
                            <img src="'.$suggestion['photo'].'" alt="" class="img-responsive">
                            <div class="caption">
                                <h4 class="text-center">'.$suggestion['titre'].'</h4>
                            </div>
                        </a>
                    </div>
                </div>';

    }
    
}
else {
    header('location:index.php');
    exit();
}



// Affichage de la confirmation des articles dans le panier

$popup = '';

if ( isset($_GET['statut_produit']) && $_GET['statut_produit']=='ajoute' ){

    $popup = '<div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Le produit a bien été ajouté au panier !</h4>
                        </div>
                        <div class="modal-body">
                            <p><a href="panier.php">Voir le panier</a></p>
                            <p><a href="index.php">Continuer ses achats</a></p>
                        </div>
                    </div>
                </div>
            </div>';
            echo $popup;
}


?>

<div class="row">
    <?= $contenu; ?>
</div>

<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">Suggestion des produits</h3>
    </div>
    <?= $aside; ?>
</div>
<!-- éventuel html -->

<?php
require_once('assets/bas.php');
?>

<script>
$(function(){
    $('#myModal').modal('show');
});
</script>
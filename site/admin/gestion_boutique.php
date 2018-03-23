<?php

require_once('../assets/init.php');

if ( !estConnecteEtAdmin() ){
    header("location:../connexion.php"); // Si pas admin : DEGAGE
    exit();
}

// Suppression
if ( isset($_GET['action']) && $_GET['action']=='suppression' && isset($_GET['id_produit'])){
    $resul = executeRequete("SELECT photo FROM produit WHERE id_produit= :id_produit", array("id_produit" => $_GET['id_produit']));
    $photo_a_supprimer = $resul->fetch(PDO::FETCH_ASSOC);
    $chemin_photo = $_SERVER['DOCUMENT_ROOT'].$photo_a_supprimer['photo'];

    if ( !empty($photo_a_supprimer['photo']) && file_exists($chemin_photo)){
        unlink($chemin_photo);
    }

    executeRequete("DELETE FROM produit WHERE id_produit = :id_produit", array('id_produit' => $_GET['id_produit']));
    $contenu.="<div class='alert alert-success'>Le produit à été supprimé</div>";
    $_GET['action']='affichage';
}

$contenu.= '<ul class="nav nav-tabs">
                <li><a href="?action=affichage">Affichage des produits</a></li>
                <li><a href="?action=ajout">Ajouter un produit</a></li>
            </ul>';

    // enregistrement du produit en BDD
    if ( $_POST ){

        $photo_bdd='';

        if (isset($_POST['photo_actuelle'])){
            $photo_bdd= $_POST['photo_actuelle'];
        }
    

        if ( !empty($_FILES['photo']['name'])){
            $nom_photo = $_POST['reference'].'-'.$_FILES['photo']['name'];
            $photo_bdd = RACINE_SITE.'photo/'.$nom_photo;
            $photo_dossier= $_SERVER['DOCUMENT_ROOT'].$photo_bdd;

            echo '<pre>';
            var_dump($nom_photo);
            var_dump($photo_bdd);
            var_dump($photo_dossier);
            echo '</pre>';

            copy($_FILES['photo']['tmp_name'], $photo_dossier);
        }

        // On enregistre le produit dans la bdd (ENFIIIN)
        executeRequete("REPLACE INTO produit VALUES (:id_produit,:reference,:categorie,:titre,:description,:couleur,:taille,:public,:photo,:prix,:stock)",array( 'id_produit'     => $_POST['id_produit'],
                'reference'     => $_POST['reference'],
                'categorie'     => $_POST['categorie'],
                'titre'         => $_POST['titre'],
                'description'   => $_POST['description'],
                'couleur'       => $_POST['couleur'],
                'taille'        => $_POST['taille'],
                'public'        => $_POST['public'],
                'photo'         => $photo_bdd,
                'prix'          => $_POST['prix'],
                'stock'         => $_POST['stock'],
        ));

        $contenu.='<div class="alert alert_success">Le produit à été enregistré</div>';
        $_GET['action'] = 'affichage';
    }




if ( (isset($_GET['action']) && $_GET['action']== 'affichage') || !isset($_GET['action']) )
{
    // affichage des produits
    $produits = executeRequete("SELECT * FROM produit");

    $nbcolonnes = $produits->columnCount();
    
    $contenu.="<h3>Produits</h3>";
    $contenu.="<p>Nombre de produits: ".$produits->rowCount()."</p>";
    $contenu.="<table class='table-striped'>
                    <tr>";
            // Les en-têtes
            for( $i=0; $i<$nbcolonnes; $i++){
                $colonne = $produits->getColumnMeta($i);
                $contenu.='<th>'.ucfirst($colonne['name']).'</th>';
                }
            
                $contenu.='<th colspan="2">Actions</th>';
    
    $contenu.="</tr>";
            // Les données
            while ( $ligne = $produits->fetch(PDO::FETCH_ASSOC) ){
                $contenu.="<tr>";
                foreach( $ligne as $indice => $information ){
                    if ( ($indice=='photo') && $information !=''){
                        $information = "<img class='img-thumbnail' src='".$information."' alt='".$ligne['titre']."'>";
                    }
                        $contenu.="<td class='text-center'>".$information."</td>";
                }
                
                $contenu.="<td><a href='?action=modifier&id_produit=".$ligne['id_produit']."'>Modifier</a>";
                $contenu.="<td><a href='?action=suppression&id_produit=".$ligne['id_produit']."'onclick='return(confirm('Êtes-vous certain de vouloir supprimer cette merde :".$ligne['titre']." ?'))'>supprimer</a></td>";

                $contenu.="</tr>";
            }
        $contenu.="</table>";
    
}

require_once('../assets/haut.php');
echo $contenu;

if ( isset($_GET['action']) && ( $_GET['action']=='ajout' || $_GET['action']=='modifier' ))
// if ([J'ai un action définie] &&(et) [elle vaut 'ajout'] ||(ou) ['Modifier'])
{
    if ( !empty($_GET['id_produit']) )
    {
        $resul = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array('id_produit'=>$_GET['id_produit']));
        $produit_actuel = $resul->fetch(PDO::FETCH_ASSOC);
    }
?>
<h3>Formulaire d'ajout ou de modification d'un produit</h3>
<form action="" method="post" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" est nécessaire pour l'envoi de fichier -->
    <input type="hidden" id="id_produit" name="id_produit" value="<?= $produit_actuel['id_produit'] ?? 0 ?>">
    
    <label for="reference">Référence</label>
    <input type="text" name="reference" id="reference" size="3" value="<?= $produit_actuel['reference'] ?? '' ?>">
    
    <label for="categorie">Catégorie</label>
    <input type="text" name="categorie" id="categorie" size="40" value="<?= $produit_actuel['categorie'] ?? '' ?>">
    
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre" size="40" value="<?= $produit_actuel['titre'] ?? '' ?>">
    
    <label for="description">Description</label>
    <textarea type="text" name="description" id="description" cols="40" rows="3"><?= $produit_actuel['description'] ?? '' ?></textarea>
    
    <label for="couleur">Couleur</label>
    <input type="text" name="couleur" id="couleur" size="40" value="<?= $produit_actuel['couleur'] ?? '' ?>">

    <label>Taille</label>
    <select name="taille">
        <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='XS') ? 'selected' : '' ?> value='XS'>XS</option>
        <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='S') ? 'selected' : '' ?> value='S'>S</option>
        <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='M') ? 'selected' : '' ?> value='M'>M</option>
        <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='L') ? 'selected' : '' ?> value='L'>L</option>
        <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='XL') ? 'selected' : '' ?> value='XL'>XL</option>
    </select>

    <label>Genre</label>
    <select name="public">
        <option <?= ( isset($produit_actuel['public']) && $produit_actuel['public']=='m') ? 'selected' : '' ?> value='m'>Homme</option>
        <option <?= ( isset($produit_actuel['public']) && $produit_actuel['public']=='f') ? 'selected' : '' ?> value='f'>Femme</option>
        <option <?= ( isset($produit_actuel['public']) && $produit_actuel['public']=='mixte') ? 'selected' : '' ?> value='mixte'>Mixte</option>
    </select>

    <label for="photo">Photo</label>
    <input type="file" name="photo" id="photo">
    <?php
        if ( isset($produit_actuel['photo']) ){
            echo '<p>Vous pouvez uploader une nouvelle photo</p>';
            echo '<img class="img-thumbnail" src="' .$produit_actuel['photo'].'" alt="'.$produit_actuel['titre'].'">';
            echo '<input type="hidden" name="photo_actuelle" value="'.$produit_actuel['photo'].'">';
            // Cet input permet de remplir $_POST sur un indice photo_actuelle la valeur de l'url de la photo stockée en base. Ainsi, si on ne charge pas de nouvelle photo, l'url actuelle sera remise en base.
        }
    ?>
    
    <label for="stock">Stock</label>
    <input type="text" name="stock" id="stock" size="4" value="<?= $produit_actuel['stock'] ?? '' ?>">
    
    <label for="prix">Prix</label>
    <input type="text" name="prix" id="prix" size="4" value="<?= $produit_actuel['prix'] ?? '' ?>">

    <input type='submit' value='Envoyer'>

</form>
<?php
}

require_once('../assets/bas.php');
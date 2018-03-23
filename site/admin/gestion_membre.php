<?php

require_once('../assets/init.php');

if ( !estConnecteEtAdmin() ){
    header("location:../connexion.php"); // Si pas admin : DEGAGE
    exit();
}

// Changement
if ( isset($_GET['action']) && $_GET['action'] == 'changestatut' && !empty($_GET['id_membre']) ){
    if ( $_GET['id_membre'] != $_SESSION['membre']['id_membre']){
        $resul = executeRequete("SELECT statut FROM membre WHERE id_membre = :id_membre", array('id_membre'=>$_GET['id_membre']));
        $membre = $resul->fetch(PDO::FETCH_ASSOC);
        $newStatut = ($membre['statut']==0) ? 1 : 0;

        executeRequete("UPDATE membre SET statut= :newstatut WHERE id_membre= :id_membre",array('id_membre'=>$_GET['id_membre'],
                'newstatut'=>$newStatut));
        $contenu.="<div class='alert alert-success'>Le statut du membre à été modifié</div>";
    }
}


// Suppression
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && !empty($_GET['id_membre']) ){
    if ( $_GET['id_membre'] != $_SESSION['membre']['id_membre'] ){
        executeRequete("DELETE FROM membre WHERE id_membre = :id_membre", array('id_membre' => $_GET['id_membre']));
        $contenu.="<div class='alert alert-success'>Ce connard à été supprimé</div>";
    }
}

$membres = executeRequete("SELECT * FROM membre");

$nbcolonnes = $membres->columnCount();

$contenu.="<h3>Les membres</h3>";
$contenu.="<p>Nombre de membres: ".$membres->rowCount()."</p>";
$contenu.="<table class='table-striped'>
                <tr>";
        // Les en-têtes
        for( $i=0; $i<$nbcolonnes; $i++){
            $colonne = $membres->getColumnMeta($i);
            if ( $colonne['name'] != 'mdp')
            {
                $contenu.='<th>'.ucfirst($colonne['name']).'</th>';
            }
        }
            $contenu.='<th colspan="2">Actions</th>';

$contenu.="</tr>";
        // Les données
        while ( $ligne = $membres->fetch(PDO::FETCH_ASSOC) ){
            $contenu.="<tr>";
            foreach( $ligne as $indice => $information ){
                if($indice != 'mdp'){
                    $contenu.="<td class='text-center'>".$information."</td>";
                }
            }
            if ($ligne['id_membre'] != $_SESSION['membre']['id_membre'])
        {
            $type_action = ($ligne['statut']==0 ? 'Promouvoir' : 'Dégrader');
            $contenu.="<td><a href='?action=changestatut&id_membre=".$ligne['id_membre']."'>".$type_action."</a>";
            $contenu.="<td><a href='?action=suppression&id_membre=".$ligne['id_membre']."'onclick='return(confirm('Êtes-vous certain de vouloir supprimer ce connard :".$ligne['nom']." ?'))'>supprimer</a></td>";
            
        }
        $contenu.="</tr>";
    }
    $contenu.="</table>";

require_once('../assets/haut.php');
echo $contenu;
require_once('../assets/bas.php');
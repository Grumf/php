<?php

require_once('assets/init.php');

$inscription = false; // Inscription pas faite, je m'en sert pour afficher le formulaire

if ( $_POST ){

    // Je poste mon formulaire d'inscription

    // Contrôles sur les champs
    $champs_vides = 0;
    foreach ( $_POST as $indice => $valeur ){
        if( empty($valeur) ){
            $champs_vides++;
        }
    }

    if ($champs_vides > 0){
        $contenu.= '<div class="alert alert-danger">Il y a '.$champs_vides.' information(s) manquante(s).</div>';    
    }

    // Vérifier qu'une chaîne contient les caractères autorisé
    $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#',$_POST['pseudo']);
    $verif_codepostal = preg_match('#^[0-9]{5}+$#',$_POST['code_postal']);

    // Expression régulière
    /*
        - Je délimite l'expression par le symbole # début et fin
        - ^ signifie "commence par tout ce qui précède"
        - $ signifie "fini par tout ce qui précède
        - [] pour délimiter les intervalles ( ici de a à z, de A à Z, de 0 à 9, et on ajoute . _ -)
        - le + pour dire que les caractères sont acceptés de 0 à x fois

            + équivalent de {1,}
            ? équivalent de {0,1}
            * équivalent de {0,}
            {5} précisemment 5
            {3,15} de 3 à 15 caractères
    */

    if( !$verif_caractere ){
        $contenu.= "<div class='alert alert-danger'>Le pseudo doit contenir 3 à 15 caractères (lettre de A à Z, chiffre de 0 à 9, _.-)</div>";
    }

    if( !$verif_codepostal ){
        $contenu.= "<div class='alert alert-danger'>Le code postal n'est pas correct</div>";
    }

    if ( $_POST['civilite'] !='m' && $_POST['civilite'] !='f'){
        $contenu.= "<div class='alert alert-danger'>De quel genre êtes-vous ?</div>";
    }

    if ( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) ){
        $contenu.= "<div class='alert alert-danger'>Adresse email incorrecte</div>";
    }

    // si tout va bien
    // je controle que le pseudo n'existe pas déjà dans la table
    // sinon, j'invite l'internaute à changer de pseudo

    $membre = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo",array('pseudo' => $_POST['pseudo']));

    if( $membre->rowCount() > 0 )
    {
        $contenu.= "<div class='alert alert-danger'>Pseudo indisponible, merci d'en choisir un autre</div>";
    }

    // Si tout va bien
    // j'insère le nouveau membre dans la table membre
    // je mets inscription à 'true'

    if ( empty($contenu) )
    {
        executeRequete("INSERT INTO membre VALUES ( NULL,:pseudo,:mdp,:nom,:prenom,:email,:civilite,:ville,:code_postal,:adresse,0)",
        array( 'pseudo' => $_POST['pseudo'],
                'mdp' => MD5($_POST['mdp']),
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
                'civilite' => $_POST['civilite'],
                'ville' => $_POST['ville'],
                'code_postal' => $_POST['code_postal'],
                'adresse' => $_POST['adresse'],
                
                        ));
        $contenu.="<div class='alert alert-success'>Vous êtes incrit sur notre site. <a href='connexion.php'>Vous connecter</a></div>";
        $inscription = true;
    }
}

require_once('assets/haut.php');
echo $contenu;

if (!$inscription){
?>
<form method="post" class="form-horizontal col-sm-6 col-sm-offset-2">
    <div class="form-group">
        <label for="log" class="col-sm-4 control-label">Login</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="log" name="pseudo">
        </div>
    </div>

    <div class="form-group">
        <label for="prenom" class="col-sm-4 control-label">Prénom</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="prenom" name="prenom">
        </div>
    </div>

    <div class="form-group">
        <label for="nom" class="col-sm-4 control-label">Nom</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="nom" name="nom">
        </div>
    </div>

  <div class="form-group">
    <label for="mdp" class="col-sm-4 control-label">Mot de passe</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="mdp" name="mdp">
    </div>
  </div>

  <div class="form-group">
    <label for="mail" class="col-sm-4 control-label">Email</label>
    <div class="col-sm-8">
      <input type="email" class="form-control" id="mail" name="email" placeholder="ex@mail.com">
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="radio">
        <label class="radio-inline">
          <input name="civilite" value='m' type="radio"> Homme
        </label>
        <label class="radio-inline">
          <input name="civilite" value='f' type="radio"> Femme
        </label>
      </div>
    </div>
  </div>

  <div class="form-group">
        <label for="adresse" class="col-sm-4 control-label">Adresse</label>
        <div class="col-sm-8">
            <textarea class="form-control" id="adresse" name="adresse"></textarea>
        </div>
    </div>

  <div class="form-group">
        <label for="cp" class="col-sm-4 control-label">Code postal</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="cp" name="code_postal">
        </div>
    </div>

  <div class="form-group">
        <label for="ville" class="col-sm-4 control-label">Ville</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="ville" name="ville">
        </div>
    </div>

  <div class="form-group">
    <div class="col-sm-offset-6 col-sm-12">
      <button type="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
  
</form>

<?php
}

require_once('assets/bas.php');
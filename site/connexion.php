<?php

require_once('assets/init.php');

// traitement
if ( isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
    // session_destroy();
    unset($_SESSION['membre']); // pour conserver le panier à la deconnexion
}

if ( estConnecte() ){
    header('location:profil.php'); // renvoie un en-tête au client pour demander la page profil
    exit(); // Puis quitte le script
}

if ( $_POST ){
    $motdepassecrypte = md5($_POST['mdp']); // Crypte le mdp saisi pour le comparer à la version cryptée du mdp enregistré en base

    // Requête de sélection pour vérifier que le membre existe et qu'il a saisi correctement ses id
    $sql = "SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp";
    $resul = executeRequete( $sql, array( 'pseudo' => $_POST['pseudo'],
                                            'mdp' => $motdepassecrypte
                                        ));

    if ( $resul->rowCount() == 1 ){
        // Si j'ai un résultat égal à 1 c'est que j'ai trouvé un membre qui a ce login et ce mot de passe
        $membre = $resul->fetch(PDO::FETCH_ASSOC);
        $_SESSION['membre'] = $membre;
        header('location:profil.php');
        exit();
    }
    else{
        $contenu.="<div class='bg-danger'>Erreur sur les identifiants</div>";
    }
}

require_once('assets/haut.php');
echo $contenu;
?>

<!-- Créer le formulaire de connexion -->
<h2 class="text-center">Inscription</h2>
<form method="post" class="form-horizontal col-md-offset-4 col-md-4">
  <div class="form-group">
    <label for="login" class="control-label">Login</label>
    <div class="">
      <input type="text" class="form-control" id="login" placeholder="Entrez votre login" name='pseudo' required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="control-label">Mot de passe</label>
    <div class="">
      <input type="password" class="form-control" id="inputPassword" placeholder="Password" name='mdp' required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-offset-4">
      <button type="submit" class="btn btn-default">Connexion</button>
    </div>
  </div>
</form>

<?php

require_once('assets/bas.php');
<!-- Vous travaillez pour un cinéma et devez créer une base de données de film. Votre base de
données s’appellera « exercice_3 ». Vous devrez ensuite créer un script qui permettra
d’ajouter et d’afficher des films. Suivez les étapes.

Étape 1 :
Cette table, nommée “movies” sera composée des champs suivants :
● title (varchar) : le nom du film
● actors (varchar) : les noms d’acteurs
● director (varchar) : le nom du réalisateur
● producer (varchar) : le nom du producteur
● year_of_prod (year) : l’année de production
● language (varchar) : la langue du film
● category (enum) : la catégorie du film
● storyline (text) : le synopsis du film
● video (varchar) : le lien de la bande annonce du film
N’oubliez pas de créer un ID pour chaque film et de l’auto-incrémenter.

Étape 2 :
Créer un formulaire permettant d’ajouter un film et effectuer les vérifications nécessaires.
Prérequis :
    ●   Les champs “titre, nom du réalisateur, acteurs, producteur et synopsis” comporteront
        au minimum 5 caractères.
    ●   Les champs : année de production, langue, category, seront obligatoirement un
        menu déroulant
    ●   Le lien de la bande annonce sera obligatoirement une URL valide
    ●   En cas d’erreurs de saisie, des messages d’erreurs seront affichés en rouge
        Chaque film sera ajouté à la base de données créée. Un message de réussite confirmera
        l’ajout du film.

Étape 3 :
Créer une page listant dans un tableau HTML les films présents dans la base de données.
Ce tableau ne contiendra, par film, que le nom du film, le réalisateur et l’année de
production.
Une colonne de ce tableau contiendra un lien « plus d’infos » permettant de voir la fiche
d’un film dans le détail.

Étape 4 :
Créer une page affichant le détail d’un film de manière dynamique. Si le film n’existe pas,
une erreur sera affichée. -->
<?php

$db = new PDO('mysql:host=localhost;dbname=exercice_3',
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
    <title>SuperFilms</title>
</head>
<body>

<?php

echo "<a href='tableau.php'><h3>Voir les films</h3></a>";

// Pas de vérification de champs vide :(
if( $_POST ){

    $resul = $db->prepare("REPLACE INTO movies VALUES (NULL,:title,:actors,:director,:producer,:video,:storyline,:year_of_prod,:language,:category)");

    $resul->execute( array('title' => $_POST['title'],
                'actors' => $_POST['actors'],
                'director' => $_POST['director'],
                'producer' => $_POST['producer'],
                'video' => $_POST['video'],
                'storyline' => $_POST['storyline'],
                'year_of_prod' => $_POST['year_of_prod'],
                'language' => $_POST['language'],
                'category' => $_POST['category'],
                ));

    echo '<div class="alert alert_success">Les informations du film ont été ajoutées.</div>';

    header('location:tableau.php');
}

?>

    <pre>
        <form action="" method="post">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" required>

            <label for="actors">Acteurs</label>
            <input type="text" id="actors" name="actors" required>

            <label for="director">Réalisateur</label>
            <input type="text" id="director" name="director" required>

            <label for="producer">Producteur</label>
            <input type="text" id="producer" name="producer" required>

            <label for="video">Bande annonce</label>
            <input type="text" id="video" name="video" required>
            
            <label for="storyline">Synopsis</label>
            <textarea name="storyline" id="storyline" cols="30" rows="10"></textarea>

            <label for="annee">Année de production</label>
            <select id="annee" name="year_of_prod" required>
            <option disabled selected>Choisissez l'année</option>
                <?php for ($annee = idate('Y') ; $annee >= 1900 ; $annee-- ){?>
                    <option value="<?= $annee ?>"><?= $annee ?></option>
                    <?php };?>
            </select>

            <label for="language">Langue</label>
            <select name="language" id="language" required>
                <option disabled selected>Choisissez la langue</option>
                <option value="francais">français</option>
                <option value="anglais">anglais</option>
                <option value="espagnol">espagnol</option>
                <option value="portugais">portugais</option>
                <option value="chinois">chinois</option>
                <option value="japonais">japonais</option>
            </select>

            <label for="category" required>Catégorie</label>
            <select name="category" id="category">
                <option disabled selected>Choisissez une catégorie</option>
                <option value="comedie">Comédie</option>
                <option value="horreur">Horreur</option>
                <option value="drame">Drame</option>
                <option value="documentaire">Documantaire</option>
                <option value="action">Action</option>
                <option value="thriller">Thriller</option>
            </select>

            <input type="submit" value="Envoyer">
        </form>
    </pre>

    <!-- JS et BOOTSTRAP -->
    <script src="./assets\js\jquery-3.3.1.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href='css/01-style.css'>
    <title>Bases du php</title>
</head>
<body>
    <h2>bases du php</h2>
    <?php
    // Ceci est un commentaire sur une ligne

    /* Ceci est un
    commentaire sur
    plusieurs lignes
    */

    echo 'Hello world !<br>'; // echo est une instruction qui nous permet de créer un affichage

    print 'Nous sommes jeudi';

    echo "<hr><h2> Variables : type, déclaration, affectation</h2>";

    $a = 127;
    echo ' a est de type ';
    echo gettype($a); // gettype() est une fonction qui renvoie type de la variable entre les parenthèses

    $b = 'bonjour';
    echo '<br>b est de type ';
    echo gettype($b);

    $c = true;
    echo '<br>c est de type';
    echo gettype($c);

    echo '<br>a vaut $a <br>';
    echo "a vaut $a"; // entre guillemets les variables sont interpretés

    echo "<h2>Concatenation</h2>";
    echo 'a est de type ' . gettype($a);
    echo '<br>a vaut ' . $a . '<br>';

    echo '<input type="text" name="nom"><br>';
    echo 'aujourd\'hui<br>';
    echo "aujourd'hui<br>";

    $prenom1="Gertrude";
    $prenom1="Ginette";
    echo $prenom1;
    echo'<br>';
    $prenom2="Poulet";
    $prenom2.="Cochon";
    echo $prenom2;

    echo '<br>'; // Solution 1

    $prenom = "Bonjour ";
    $prenom.= "Chloé !";
    echo $prenom;

    echo '<br>'; // Solution 2

    $monprenom='Chloé';
    echo "Bonjour $monprenom !<br>  ";
    echo 'Bonjour '. $monprenom;

    echo '<br><br><h2>Constantes et Constantes magiques</h2>';

    define('CAPITALE','Paris'); // Je défini une constante CAPITALE
    echo CAPITALE. '<br>';
    // define('CAPITALE', 'Lyon'); je ne peux pas modifier ou redefinir une constante.

    // exemple de constante magiques
    echo __FILE__; // renvoi le fichier dans lequel on se trouve
    echo "<br>";
    echo __LINE__; // Renvoi la ligne
    echo "<br>";

    echo "<br><h2>Opérateurs arithmétiques</h2>";

    $a=10;
    $b=2;

    echo $a + $b . '<br>';
    echo $a - $b . '<br>';
    echo $a * $b . '<br>';
    echo $a / $b . '<br><br>';
    // Opération + réaffectation

    $a += $b; // équivaut a $a = $a + $b
    echo $a . '<br>';
    $a -= $b; // équivaut a $a = $a - $b
    echo $a . '<br>';
    $a++; // Incremente
    echo $a . '<br>';
    $a--; // Décremente
    echo $a . '<br><br>';

    echo '<h2>Structures conditionnelles (if/else) - opérateurs de comparaison</h2>';

    // isset et empty

    $var1 = 0;
    $var2 = '';

    if ( empty($var1) ) echo '0, vide ou non definie<br>';
    if ( isset($var2) ) echo 'var2 existe et est definie par rien<br>';
    if ( isset($var3) ) echo 'var3 est definie<br>';
    if ( empty($var3) ) echo 'var3 vaut soit 0, soit est vide, soit n\'est pas défini<br>';

    /* empty vérifie si la variable testée est : - Non définie
                                                - Définie égale à 0
                                                - vide 
            
        isset vérifie si la variable a été définie (independamment de sa valeur)

        ex : empty nous permettra de tester si un champ de formulaire a été laissé vide
    */

    // if, else, elseif
    $a=10; $b=5; $c=2;
    if ($a > $b ){
        echo "a est supérieur à b<br>";
    }
    else {
        echo "a est inférieur à b<br>";
    }

    // Equivalent
    if ($a > $b) :
        echo "a est supérieur à b<br>";
    else :
        echo "a est inférieur à b<br>";
    endif;

    echo '<hr>';

    // conditions ET &&
    if ($a > $b && $b > $c){
        echo "OK pour les deux conditions<br>";
    }

    // Condition OU ||
    if ( $a==9 || $b > $c){
        echo "OK pour au moins 1 condition<br>";
    }

    // Condition OU exclusif XOR
    if ($a==10 XOR $b==5){
        echo "OK pour une des conditions seulement";
    }

    // IF forme contractée

    echo ( $a == 10 ) ? "a est égal à 10" : "a n'est pas égal à 10"; // echo ( condition ) ? "VRAI" : "FAUX" ;

    echo '<br>';

    $var1 = isset($maVar) ? $maVar : 'valeur_par_défaut'; // $maVar est définie ? OUI : NON
    echo $var1;

    // Ternaire courte PHP 7
    $var2 = $maVar ?? 'valeur_par_défaut';
    // Equivalent $var2 = isset($maVar) ? $maVar : 'valeur_par_défaut'

    $var3 = $maVar1 ?? $maVar2 ?? 'valeur_par_défaut'; // avec cette formulation, on affectera à var3 la première des valeurs définie (maVar1 ou maVar2) sinon ce sera la valeur par défaut
    ?>
    <input type="text" value="<?= $_POST['email'] ?? '' ?>" name="email">
    <?php
    $a = 1;
    $b = "1";
    if( $a == $b )
    {
        echo "c'est la même chose en valeur.";
    }

    if( $a === $b ){
        echo "c'est la même chose ne valeur et en type.";
    }

    /*
    = affectation
    == comparaison en valeur ( 11 == '11' )
    === comparaison en valeur et en type ( 11 === 11 ) */

    if ( !isset($var4) )
    {
        echo "var3 n'est pas définie<br>";
    }

    $a=5;
    $b=2;

    if ($a != $b ){
        echo "a est différent de b<hr><br>";
    }

    // elseif

    $couleur='noir';

    if ( $couleur == 'bleu'){
        echo 'vous aimez le bleu<br>';
    }
    elseif ( $couleur == 'rouge' ){
        echo 'vous aimez le rouge<br>';
    }
    else {
        echo "vous n'aimez ni le bleu, ni le rouge<br><br>";
    }

    echo '<h2>Condition Switch</h2>';

    switch ( $couleur ){
        
        case 'bleu' : echo 'vous aimez le bleu<br>';
        break;
        
        case 'rouge': echo 'vous aimez le rouge<br>';
        break;
        
        case 'vert' : echo 'vous aimez le vert<br>';
        break;
        
        default     : echo 'vous êtes chiant<br>';
        break;
    }

    echo '<br><h2>Fonctions prédéfinies</h2>';

    echo 'Date : ' . date('d/m/Y');
    echo '<br>';
    // mktime (0,0,0,1,1,2018) heure, minute, seconde, mois, jour, année
    // echo mktime(0,0,0,12,25,1984);
    echo 'Le premier janvier 2018 tombait un ' . date('l', mktime(0,0,0,1982));
    echo '<br>';
    echo 'Maintenant : ' . date('Y-m-d H:i:s') . ' et nous sommes en semaine ' . date('W');
    echo '<hr><br>';

    // Taitement de chaine de caractère
    $email = 'prenom@site.fr';
    echo strpos($email, '@'); // Indique la position du caractère @ dans l'email (ici 6)
    echo '<br>';
    $email2 = 'bonjour';
    echo strpos($email2,'@'); // Boolean qui vaut 'false' donc ne renvoi rien

    if ( strpos($email2,'@')){
        echo 'le signe @ dans la chaine $email2 se trouve à la position' . strpos($email2, '@') . '<br>';
    } else {
        echo 'je n\'ai pas trouvé le signe @ dans $email2';
    }

    var_dump( strpos($email2,'@')); // var_dump donne des indications sur son contenu (bool(false))
    $i = 6; var_dump($i); // int(6);
    $j ="moi"; var_dump($j); // string(3) "moi"
    var_dump(CAPITALE); // 'Paris'

    echo '<hr><br>';

    $phrase = "ici je me mets une super phrase de ouf trop bien";
    echo strlen($phrase); // "strlen = string length"

    $texte = '<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet enim sed mauris varius mollis vel ac metus. Vestibulum venenatis ipsum id tortor congue commodo. Aenean venenaitis lorem quis mi pulvinar, et pretium dolor condimentum. Donec sed masesa effuicitur turpis dapibus rutrum non in purus. Duis ultricies vel ligula quis suscipit. Duis ac ligula vel erat dictum fringuilla. Nunc vulputate, diam ut vehicula hendrezrit, augue ante euismod urna, nec ultricies dolor nunc vitae metus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis ut aliquam diam, eu pretium elit. Etiam tellus mauris, viverra in sem ut, dictum varius sapien.';

    echo substr($texte,0,20) . '...<a href="">lire la suite</a>'; // Substring extrait une sous-chaîne de la chaine $texte, en partant de la position 0 et sur une longueur de 20 caractères.

    echo "<br><br><h2>Fonctions utilisateur</h2>";

    function vdm($var){
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }

    vdm($texte);

    function separation(){
        return '<hr>';
    }

    echo separation();

    function bonjour($qui){
        return 'Bonjour ' . $qui . '!';
    }

    $prenom = 'Chloé';
    echo bonjour($prenom);
    echo '<br>';
    echo bonjour('Trouducul');

    function appliqueTva($nombre){
        return $nombre*1.2;
    }

    function appliqueTva2($nombre,$taux=1.2){
        return $nombre*$taux;
    }

    echo "10 euros avec la TVA à 20% font ". appliqueTva(10)."€ <br>";
    echo "100 euros avec la TVA à 20% font ". appliqueTva(100)."€ <br>";
    echo "100 euros avec la TVA à 5,5% font ". appliqueTva2(100,1.055)."€ <br>";

    echo appliqueTva2(100);
    echo appliqueTva2(100,1.055);


    function jourSemaine(){
        $jour="lundi";
        return $jour;
        echo "allo"; // cette commande se situant après le return ne sera pas executée
    }

    // echo $jour ne fonctionne pas car cette variable est connue que dans la fonction

    $recup = jourSemaine();
    echo $recup;

    $pays = 'France';
    function affichePays(){
        global $pays; // je globalise la variable Pays dans la fonction car elle fait partie de l'environnement global
        echo $pays. ' ' .CAPITALE; // Une constante est d'office globalisée
    }

    affichePays();
    echo '<br>';

    function facultatif(){
        // vdm( func_get_args() );
        // func_get_args() est une commande qui créé un tableau associatif avec les arguments fournis à la fonction dans laquelle je l'appelle.
        foreach (func_get_args() as $indice => $element ){
            echo $indice . '->' . $element . '<br>';
        }
    }

    facultatif();
    facultatif("France","Italie");
    facultatif(1,2,3); 

    echo "<hr><h2>Structures intéractives : boucles</h2>";

    $i=0;
    while ( $i < 3 ){
        echo "$i --";
        $i++; // variation de i
    }

    echo '<br>';

    $r=0;
    while ( $r <= 10 ){
        echo "$r -";
        $r+=2;
    }

    // boucle for
    for ( $j=0 ; $j <=10 ; $j++ ){
        echo $j.'#';
    }

    // EXERCICE

    ?>

    <select name="choix">
    <?php for ( $annee=(idate('Y')-13) ; $annee >=1950 ; $annee-- ) : ?>
    <option value="<?= $annee ?>"><?= $annee ?></option><?php endfor;?>
    
    </select>

    <table>
    <?php
    for ( $col=1 ; $col < 15 ; $col++ ){
        ?><tr>
        <?php
        for ( $row=1 ; $row < 20 ; $row++ ){ ?><td>(°-°)</td> <?php } ?>
        </tr>
    <?php }; ?>
        
    </table>
    <?php

        echo "<br><hr><h2>Inclusion de fichiers</h2>";

        echo "première fois<br>";
        include('exemple.php');

        echo "<br>2e fois<br>";
        include_once('exemple.php');
        echo 'Ca ne marche pas. "include_once" ne peut pas être réutilisée<br>';

        echo "<br>3e fois<br>";
        require('exemple.php'); // Require requiert qu'il n'y ai pas d'erreur au niveau du ficher inclu. Le script s'arrête dans ce dernier cas.

        echo "<br>4e fois<br>";
        require_once('exemple.php');
        echo 'Ca ne marche pas. "require_once" ne peut pas être réutilisée<br>';

        echo "<br><hr><h2>Tableau de données : ARRAY</h2>";

        $liste = array('Ruben','Hamid','Moundir','Olivier','Romain','Chloe');

        vdm($liste);

        $fruits = array();
        $fruit[]= 'pomme';
        $fruit[]= 'poire';
        $fruit[]= 'orange';

        vdm($fruit);

        $fruit2 = array( 'pm' => 'pomme', 'pr' => 'poire', 'og' => 'orange');

        vdm($fruit2);

        $fruit2[]= 'cerise'; // Ajoute un élément au tableau avec un index incrémenté
        $fruit2['bn'] = 'banane'; // Ajoute un élément avec la valeur 'banane' et un index 'bn'
        $fruit2['pm'] = 'pêche'; // Modifie la valeur à l'index 'pm'

        vdm($fruit2);

        $fruit2[]= 'kiwi'; // incrémente à 1 (suite cerise)
        $fruit2[99]= 'clémentine'; // incrémente à 99
        $fruit2[]= 'raisin'; // incrémente à 100 (suite de 'clémentine')


        // Boucle foreach
        
        foreach( $fruit2 as $info){
            echo $info. '-';
        }

        echo '<br>';

        foreach( $fruit2 as $indice => $valeur){
            echo "à l'indice $indice je trouve $valeur";
        }

        /* syntaxe :    foreach ( montableauaparcourir as index => valeur )
                        foreach ( montableauaparcourir as valeur ) */


        // Tableau multidimensionnel

        $superheros = array(
            'Superman' => array (
                'nom' => 'Kent',
                'prenom' => 'Clark',
                'univers' => 'DC Comics' ),
            'Spiderman' => array (
                'nom' => 'Parker',
                'prenom' => 'Peter',
                'univers' => 'Marvel' ),
            'Batman' => array (
                'nom' => 'Wayne',
                'prenom' => 'Bruce',
                'univers' => 'DC Comics' ),
            'Ironman' => array (
                'nom' => 'Starck',
                'prenom' => 'Tony',
                'univers' => 'Marvel' ),
            );

            // vdm($superheros);
            echo '<br>';
            echo count($superheros);
            echo '<br>';
            echo sizeof($superheros);
            // Count() et sizeof() indiquent tous les deux le nb d'éléments
            echo '<br>';
            echo $superheros['Batman']['prenom']; // Bruce
            echo '<br>';
            echo $superheros['Spiderman']['univers']; // Marvel

            foreach($superheros as $heros => $valeur){
                echo '<p>'.$heros.'</p>';
                foreach($valeur as $info => $valeur2){
                    echo $valeur2;
                }
            }

        $fruits3 = array ('pomme','cerise','orange');

        $nbelements = count($fruits3);

        for ($i=0; $i<$nbelements; $i++){
            echo $fruits3[$i].'-';
        }

        echo "<br><hr><h2>Objet</h2>";

        class Etudiant
        {
            public $prenom = 'Julien'; // public : accessible à l'extérieur de la class
            public $age = 25;
            public function pays(){
                return 'France';
            }
        }

        $objet = new Etudiant;
        vdm($objet);
        vdm(get_class_methods($objet));
        echo $objet->age;

        echo $objet->pays();
        $objet->prenom = 'Jeanne';
        vdm($objet); // Affiche l'objet avec "Jeanne"
        $objet2 = new Etudiant;
        vdm($objet2); // Affiche l'objet avec "Julien"

    ?>
    <?= '<br><br>++<(°-°<)++' ?> <!-- revient à < ? php echo -->
</body>
</html>

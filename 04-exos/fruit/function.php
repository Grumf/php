<?php

function calcul($fruit_choisi, $poids){

    switch($fruit_choisi)
    {
        case 'cerise' : $poi=( $poids * 5.76 ) ;break;
        case 'banane' : $poi=( $poids * 1.09 ) ;break;
        case 'peche' : $poi=( $poids * 1.61 ) ;break;
        case 'pomme' : $poi=( $poids * 3.23 )  ;break;
        default : echo "Veuillez choisir un fruit et entrer un poids en chiffre(s)<br>"; ;break;
    }

    return "Les $fruit_choisi coutent $poi € pour $poids Kg";

}

?>
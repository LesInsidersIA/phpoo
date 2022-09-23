<?php 

class Societe 
{
    public $adresse;
    public $ville;
    public $cp;

    public function __construct(){} // on connait déjà, se lance directement à l'instanciation de l'objet
    public function __set($nom, $valeur){ // Se déclenche uniquement en cas de tentative d'affectation sur une propriété qui n'existe pas
        echo "La propriété $nom n'existe pas, donc la valeur $valeur n'a pas été affectée ! <hr>";
    }
    public function __get($nom) { // Se déclenche uniquement en cas de tentative d'appel sur une propriété qui n'existe pas 
        echo "La propriété $nom n'existe pas, pas d'affichage possible !<hr>";
    }
    public function __call($nom, $argument) { // se déclenche uniquement en cas de tentative d'appel sur une méthode qui n'existe pas
        echo "Tentative d'exécuter la méthode $nom mais elle n'existe pas.<br> Les arguments étaient " . implode(" - ", $argument) . "<hr>";
        // implode : méthode prédéfinie me permettant de transformer un array en string, en séparant chacun des éléments par le séparateur choisi en premier argument
        // explode : c'est son inverse, on transforme une chaine de caractère en array pour peu qu'on puisse séparer les éléments via des séparateurs exemple :  (prenom,question1,question2,question3) là on choisirait d'utiliser la virgule comme séparateur d'éléments
    }

}

$soc = new Societe;

$soc->titre = 'Decathlon'; // création de la propriété titre bloquée grâce à la méthode magique __set
echo '<pre>';
print_r($soc);
echo '</pre>';
echo '<pre>';
print_r(get_class_methods($soc));
echo '</pre>';
echo $soc->titre; // déclenchement de l'erreur d'appel sur la propriété qui n'existe pas bloquée grâce à la methode magique __get 

$soc->ajoutEmploye(124, "Jack", "Sparrow", 2000);

/* 

    - Les méthodes magiques s'executent automatiquement (si elles sont définies), il faut simplement définir le traitement que l'on souhaite

    Autres méthodes magiques en PHP OO : 
    __callStatic($nom, $argument) : Lorsque l'on appelle une méthode statique non existante
    __isset($nom) : Lorsque l'on fait un isset sur une propriété n'existant pas
    __destruct() : Se lance à la fin de l'exécution d'un script, lorsque l'objet est détruit de la mémoire (pour éventuellement sauvegarder des éléments)
    __toString() : Se lance lorsque un objet est tenté d'être affiché par un 'echo'

*/

<?php 

class Ecole 
{
    public $nom = 'Doranco';
    public $cp = 92;

    public function __clone()
    {
        // Un clone peut se faire même en l'absence de cette méthode. 
        // Si elle est présente, elle s'exécutera en cas de clone demandé et s'appliquera sur l'objet cloné !!!! (et non pas celui qui sert au clonage)
        $this->cp = "CP à définir";
    }
    
}

$ecole1 = new Ecole; // création de l'objet #1
$ecole2 = new Ecole; // création de l'objet #2
$ecole2->nom = "Webforce";
echo '<pre>';
var_dump($ecole1);
echo '</pre>';
echo '<pre>';
var_dump($ecole2);
echo '</pre>';

$ecole3 = $ecole1; // Ici je ne créer pas un nouvel objet !!! j'ajoute simplement $ecole3 comme pointeur vers le même objet que pointe $ecole1 à savoir l'objet #1, une modification sur $ecole3 ou $ecole1 impactera le même objet #1
$ecole3->cp = 75;
$ecole1->nom = "Pouet";
echo 'Ecole3 : <pre>';
var_dump($ecole3);
echo '</pre>';
echo 'Ecole1 : <pre>';
var_dump($ecole1);
echo '</pre>';

$ecole4 = clone $ecole2; // clone créé un nouvel objet indépendant en copiant les valeurs de l'objet nommé après, ici on prends pour exemple $ecole2 pour créer l'objet contenu dans $ecole4
echo 'Ecole4 : <pre>';
var_dump($ecole4); // nous représente l'objet nouvelle créé, #3, avec les mêmes valeurs que $ecole2 pour ses propriétés (nom : Webforce)
echo '</pre>';

/* 

    En gros, j'ai 4 variables, pour seulement 3 objets en mémoire.

        MEMOIRE
    |--------------------------|
    |______Objet#1 Doranco92   | <--------- représenté par $ecole1 et $ecole3
    |______Objet#2 Webforce92  | <--------- représenté par $ecole2
    |____Objet#3 WebforceCPàdef| <--------- représenté par $ecole4

*/
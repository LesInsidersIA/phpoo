<?php

class Perso
{
    protected function deplacement()
    {
        return "Je me déplace vite";
    }

    public function sauter()
    {
        return "Je saute haut";
    }
}

#############################################

// extends est un mot clé qui permet de représenter l'héritage
// la classe Mario hérite de toutes les méthodes et propriétés (public, protected) de la classe perso
// Toutes les méthodes de la classe Perso sont accessibles directement dans la classe Mario 

class Mario extends Perso // Il n'est pas possible d'hériter de plusieurs classes à la fois
{
    public function quiSuisJe()
    {
        // On créer une méthode qui va appeler les méthodes issues de la classe Perso (on hérite de tous les éléments protected et public, donc on récupère sauter() et deplacement())
        return "Je m'appelle Mario et " . $this->deplacement() . " et " . $this->sauter() . "<hr>";
    }
}

##########################################

class Bowser extends Perso
{
    public function quiSuisJe()
    {
        return "Je m'appelle Bowser et " . $this->deplacement() . " et " . $this->sauter() . "<hr>";
        // parent::sauter();
    }

    // redéfinition de la méthode héritée sauter(), par défaut, php appelle la méthode de l'objet (on reste au meme niveau), et si seulement il ne trouve pas la méthode qu'on appelle, il appelera la méthode de la classe mère
    public function sauter()
    {
        return "Je ne saute pas vraiment haut";
    }
}

$mario = new Mario;
$bowser = new Bowser;
$perso = new Perso;

echo '<pre>';
var_dump(get_class_methods($mario));
echo '</pre>';

echo $mario->quiSuisJe();
echo $bowser->quiSuisJe(); // affiche je ne saute pas vraiment haut, la méthode ayant été redéfinie dans la classe bowser

echo '<pre>';
var_dump(get_class_methods($bowser));
echo '</pre>';


/*  

    L'héritage représente la récupération de tous les éléments public et protected d'une classe par une autre, via le mot extends

    Les propriétés ainsi que les méthodes tant qu'elles respectent ces niveaux de visibilité, sont récupérées

    Attention à respecter un contexte cohérent dans l'héritage

    C'est à dire : Il faut pouvoir dire que A est un B 
        un bateau est un vehicule
        un chien est un animal 

    Si je redéfinie une méthode que j'ai hérité, la méthode présente dans la classe, prends la priorité sur la méthode récupérée par héritage. Je pourrais malgré tout récupéré le traitement de la méthode héritée en utilisant l'appel parent::

*/
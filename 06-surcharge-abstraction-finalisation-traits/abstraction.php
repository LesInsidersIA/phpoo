<?php 

abstract class Joueur 
{
    public function seConnecter()
    {
        return $this->etreMajeur();
    }

    abstract public function etreMajeur(); // Les méthodes abstraites n'ont pas de contenu, les accolades provoquent une erreur

    abstract public function devise(); // Les méthodes abstraites n'ont pas de contenu, les accolades provoquent une erreur
}

// $joueur = new Joueur; // ATTENTION il n'est pas possible d'instancier une classe abstraite

class JoueurFr extends Joueur 
{
    public function etreMajeur() // Je suis obligé de redéfinir mes deux méthodes abstraites héritées de ma classe Mère sinon j'obtiens une erreur
    {
        return 18;
    }

    public function devise()
    {
        return "€";
    }
}

class JoueurUs extends Joueur 
{
    public function etreMajeur() // Je suis obligé de redéfinir mes deux méthodes abstraites héritées de ma classe Mère sinon j'obtiens une erreur
    {
        return 21;
    }

    public function devise()
    {
        return "$";
    }
}

class JoueurJp extends Joueur 
{
    public function etreMajeur() // Je suis obligé de redéfinir mes deux méthodes abstraites héritées de ma classe Mère sinon j'obtiens une erreur
    {
        return 20;
    }

    public function devise()
    {
        return "Y";
    }
}

##########################################
$joueurFr = new JoueurFr;
echo "Age pour jouer en France : " . $joueurFr->etreMajeur() . '<hr>';
echo "Devise pour jouer en France : " . $joueurFr->devise() . "<hr>";

/*  

    - Une classe abstraite n'est pas instanciable
    - Les méthodes abstraites n'ont pas de contenu
    - Lorsque l'on hérite de méthodes abstraites, nous sommes obligés de les redéfinir
    - Pour définir des méthodes abstraites, il est nécessaire que la classe qui les contient soit abstraite
    - Une classe abstraite peut contenir des méthodes normales

    - On se créer un cadre strict de développement en s'assurant que toute l'équipe travaille dans la même direction en nommant les méthodes exactement de la même façon (forcé par l'héritage d'une classe abstract)


*/
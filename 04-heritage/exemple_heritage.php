<?php 

class Membre 
{
    public $id = 15;
    public $pseudo;
    public $mdp;

    public function __construct()
    {
        echo "Internaute !<hr>";
    }

    public function inscription()
    {
        // traitement....
        return "je m'inscris<hr>";
    }

    public function seConnecter()
    {
        // traitement... session etc...
        return "Je suis connecté<hr>";
    }
}
// ---------------------------------------
class Admin extends Membre 
{
    public function accesBackOffice()
    {
        return "Accès BackOffice : Oui!<hr>";
    }
}

// Ici, contexte d'héritage ! Un admin est avant tout un membre, donc un admin aura accès à tout ce qui fait un membre, donc les propriétés id, pseudo etc, les méthodes s'inscrire, se connecter etc
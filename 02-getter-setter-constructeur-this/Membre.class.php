<?php

/******************************* 
 
    EXERCICE :
        En tenant compte des éléments appris dans ce chapitre, essayez de renseigner puis d'afficher les attributs de cette classe :

        class Membre {
            private $prenom;
            private $age;
        }

        // On souhaite également ajouter des contraintes de saisies sur le prenom avec maximum 20 caractères et un age forcément numérique
        // Gérer les cas d'erreur avec la fonction trigger_error()

        // Une fois la classe écrite, testez, instanciez des objets, manipulez vos méthodes

        // Une fois que tout est ok, faites un constructeur
 */

class Membre
{
    private $prenom;
    private $age;

    public function __construct($newPrenom, $newAge)
    {
        echo "Instanciation......... Nous avons reçu les info suivantes : $newPrenom et $newAge<hr>";
        $this->setPrenom($newPrenom);
        $this->setAge($newAge);
    }

    public function setPrenom($newPrenom)
    {
        if (is_string($newPrenom)) {
            if (iconv_strlen($newPrenom) <= 20)  $this->prenom = $newPrenom;
              else trigger_error("Attention, le prénom doit faire moins de 20 carac", E_USER_ERROR);
        } else trigger_error("Attention, c'est pas un string !", E_USER_ERROR);
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setAge($newAge)
    {
        if (is_numeric($newAge)) $this->age = $newAge;
        else trigger_error("Pas un chiffre!", E_USER_ERROR);
    }

    public function getAge()
    {
        return $this->age;
    }
}

// $membre1 = new Membre;
// $membre1->setPrenom("Eddy");
// $membre1->setAge(55);
// echo "Le prenom du membre1 est : " . $membre1->getPrenom() . ", et il a " . $membre1->getAge() . "ans<hr>";

$membre2 = new Membre("Polo", 25);
echo "<pre>";
print_r($membre2);
echo "</pre>";

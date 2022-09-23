<?php

class Etudiant
{
    private $prenom;
    // Bob 
    public function __construct($newPrenom)
    { // Méthode magique se lançant directement à l'instanciation d'un objet. A pour but d'automatiser certaines taches. Attention aux deux underscores devant __
        echo "Coucou instanciation d'un nouvel objet étudiant, la valeur reçue est : $newPrenom<hr>";
        //Bob
        //Bob
        $this->setPrenom($newPrenom);
        //Bob
        echo "Bonjour étudiant " . $this->getPrenom();
    }
    // Jack
    public function setPrenom($newPrenom)
    { // setter l'information = la renseigner et la controler
        // Jack  => true
        if (is_string($newPrenom)) {
            //  $etudiant1->prenom = "Jack";   
            $this->prenom = $newPrenom; // $prenom = $newPrenom; ne fonctionne pas car on ne connait pas $prenom dans l'espace local
            // $etudiant1->prenom = $newPrenom
        } else {
            // Fonction prédéfinie trigger_error me permet de générer des erreurs utilisateurs
            trigger_error("Ce n'est pas une chaine de caractères", E_USER_ERROR);
        }
    }

    public function getPrenom()
    { // getter permet d'exploiter une donnée privée
        return $this->prenom;    // return $prenom; ne fonctionne pas car on ne connait pas $prenom dans l'espace local 
    }
}

// $etudiant1 = new Etudiant;
// // $etudiant1->prenom = "Jack"; // error visibilité private
// $etudiant1->setPrenom("Jack"); // Fonctionnera
// echo '<pre>';
// print_r($etudiant1);
// echo '</pre>';

// echo "Bonjour étudiant " . $etudiant1->getPrenom();

/* 

    Les getters / setters permettent de controler l'intégrité des données
    Si nous devons controler les données saisies dans un formulaire, chaque donnée devra être transmise à une fonction setter qui permettra de controler la validité de la donnée

    setter = controle les données avant de les affecter dans leurs propriétés
    getter = permet de récupérer pour afficher/voir/exploiter les données finales

    $this  représente l'objet en cours d'utilisation à l'intérieur de la classe 

    Mettre les propriétés en private permet d'éviter qu'elles ne soient modifiées sans respecter le format dans lequel on les attends (on controle tout ça dans le setter, contrainte saine)

*/

$etudiant2 = new Etudiant("Bob");
$etudiant2->setPrenom("Jimmy");

echo "Bonjour vous êtes convoqué " . $etudiant2->getPrenom();

/* 

    __construct() est une méthode magique en PHP. 
    Elle s'exécute automatiquement lors d'une instanciation de classe (lorsque l'on fait un new)
    Si la méthode magique __construct($newPrenom) attend un argument, nous avons l'obligation de lui envoyer à l'instanciation (sauf si l'argument est facultatif...), sinon cela provoquera une erreur
    __construct() a pour but d'automatiser un traitement, dans notre cas ci dessus, au lieu de faire l'instanciation PUIS le renseignement du $prenom de l'étudiant, on fait tout en un grâce au constructeur.

    Il ne peut y avoir qu'un seul constructeur par classe

    Les méthodes magiques sont toujours appelées avec 2 '__' underscore suivi du nom de la méthode magique


*/
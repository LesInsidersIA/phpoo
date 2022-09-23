<?php 

// Une Classe = Plan, Modele 
    // Une classe est un regroupement d'informations (propriétés, méthodes)
    // Relativement à un sujet global
// Objet = instance produite de cette classe 

// Par convention d'écriture on écrira toujours une classe avec sa première lettre en majuscule 

class Panier {

    // Des propriétés (et non pas des variables)
    public $nbProduit;
    protected $titreProduit;
    private $prixProduit;
    

    // Des méthodes (et non pas des fonctions)
    public function ajouterArticle(){
        // echo $this->affichageArticle();
        return "L'article a bien été ajouté.<hr>";
    }

    protected function retirerArticle(){
        return "L'article a bien été retiré.<hr>";
    }

    private function affichageArticle(){
        return "Voici les articles.<hr>";
    }
}

// echo $nbProduit; // Ceci ne fonctionne pas (undefined variable) car dans une classe nous sommes dans un espace local

// Il faut d'abord instancier un objet de cette classe, c'est à dire créer un objet de la classe Panier

$panier1 = new Panier;
// echo $panier1; // On ne peut pas afficher un objet avec un echo, error object to string conversion

// var_dump et print_r ne me retournent que les propriétés
echo '<pre>'; var_dump($panier1); echo '</pre>';
echo '<pre>'; print_r($panier1); echo '</pre>';

// object(Panier)#1 (3) {
//     ["nbProduit"]=>
//     NULL
//     ["titreProduit":protected]=>
//     NULL
//     ["prixProduit":"Panier":private]=>
//     NULL
//   }
//
//   Panier Object
//   (
//       [nbProduit] => 
//       [titreProduit:protected] => 
//       [prixProduit:Panier:private] => 
//   )

// Si je veux voir les méthodes je dois utiliser get_class_methods
echo '<pre>'; var_dump(get_class_methods($panier1)); echo '</pre>';
echo '<pre>'; print_r(get_class_methods($panier1)); echo '</pre>';
// array(1) {
//     [0]=>
//     string(14) "ajouterArticle"
//   }
//   Array
//   (
//       [0] => ajouterArticle
//   )

$panier1->nbProduit = 5; // Attention à ne pas mettre le $ car lors d'un appel avec la fleche ->   on comprends déjà être dans l'objet $panier1
echo '<pre>'; print_r($panier1); echo '</pre>';
echo '<pre>'; var_dump($panier1); echo '</pre>';

// $panier1->titreProduit = 'pantalon'; // Uncaught Error: Cannot access protected property
// Impossible d'accéder à une propriété protected 

// $panier1->prixProduit = 50; // Uncaught Error: Cannot access private property
// Impossible d'accéder à une propriété private 

echo "Nombre de produits : $panier1->nbProduit<hr>";


// On tente maintenant avec les méthodes 
echo $panier1->ajouterArticle(); // Pas de soucis pour l'appel de la méthode public

// echo $panier1->retirerArticle(); // Fatal error, on ne peut pas appeler une méthode de niveau protected 

// echo $panier1->affichageArticle(); // Fatal error, on ne peut pas appeler une méthode de niveau private

// Autrement dit, depuis l'extérieur de la classe on ne peut appeler que les éléments d'un niveau de visibilité public
// Nous sommes limité pour pouvoir atteindre les éléments protected/private qui eux seront directement accessible uniquement dans l'espace local de la classe.

$panier2 = new Panier;
echo '<pre>'; var_dump($panier2); echo '</pre>';
// Ce nouvel objet est complêtement indépendant du premier, identifiant différent (#2), nombre d'articles différent 
$panier2->nbProduit = 133;
echo '<pre>'; print_r($panier1); echo '</pre>';
echo '<pre>'; print_r($panier2); echo '</pre>';

/*  

    Une classe est un plan de construction, un modèle qui permet de regrouper des données, des informations.
    Pour exploiter ce qui est déclaré dans les classes, nous devons créer une instance, un objet, issue de la classe grâce au mot clé 'new'
    Une classe peut produire plusieurs objets (sans limite autre que votre mémoire). Le mot clé new permettant donc de créer un exemplaire de la classe, un enfant de la classe.
    $panier1 représente l'objet issu de la classe Panier 

    ********************************************

    Niveau de visibilité : 

        public : accessible de partout (aussi bien à l'intérieur qu'à l'extérieur des classes)

        protected : accessible uniquement dans la classe où cela a été déclaré MAIS AUSSI dans les classes héritières

        private : accessible uniquement dans la classe où cela a été déclaré

        // Les niveaux de visibilité permettent de protéger des tentatives d'intrusion dans les propriétés/méthodes ou de moficiation accidentelle. 
        // Egalement pour créer des contraintes saines de développement pour bloquer les modifications et respecter la modélisation du projet

    Quand vous instanciez un objet, la variable stockant l'objet ne sstocke en fait pas exactement l'objet lui même mais un identifiant qui représente cet objet en mémoire (visible avec var_dump #1 #2 #3)

*/

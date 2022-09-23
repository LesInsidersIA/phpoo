<?php 

// LES DESIGN PATTERN :

// Un design pattern/patron de conception, est un arrangement de modules reconnus comme bonne pratique en réponse à une problématique de conception.
// Il s'agit d'un concept destiné à resoudre des problèmes récurrents. 

// 3 familles de pattern :

    // - Construction : Pour définir comment faire l'instanciation et la configuration des classes et objets 

    // Structuraux : Ils définissent comment organiser les classes d'un programme dans une structure plus large

    // Comportementaux : Pour définir comment organiser les objets pour que ceux-ci collaborent entre eux.

// Le Singleton, en programmation OO, répond à la problématique de n'avoir qu'une seule et uniquement instance d'une même classe dans un programme.
// Par exemple : en Web, la connexion à notre BDD 
// Afin de préserver cette unicité, il est judicieux de suivre le pattern Singleton 

class Singleton 
{
    private static $instance = null;

    private function __construct() {}

    public static function creation()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }
}

// $singleton = new Singleton; // la méthode magique __construct déclarée en private, m'empêche d'instancier mon objet depuis l'extérieur de la classe 

$a = Singleton::creation(); // le premier appel de la méthode creation permet d'instancier le premier et seul et unique objet de notre classe Singleton et en retourne la valeur dans $a, c'est l'objet #1
$b = Singleton::creation(); // le deuxieme et troisieme appel de la méthode création comprends que l'objet est déjà instancié (car présent dans $instance) donc on en retourne simplement la valeur, qui est toujours l'objet #1   $b représente aussi #1
$c = Singleton::creation(); // $c représente aussi #1

echo 'Variable $a<pre>';
var_dump($a);
echo '</pre>';
echo 'Variable $b<pre>';
var_dump($b);
echo '</pre>';
echo 'Variable $c<pre>';
var_dump($c);
echo '</pre>';

/* 

    La classe n'est pas instanciable depuis l'extérieur puisque le constructeur est déclaré volontairement comme étant privé
    On exécute la méthode static creation() de la classe Singleton, la premiere fois l'instance possède la valeur 'null', donc nous créons un objet Singleton à l'intérieur de la classe qui est ensuite return
    $a représente un objet issue de la classe Singleton avec la référence #1 en mémoire
    La seconde fois, l'instance n'est pas null, nous ne rentrons pas dans le if et l'objet est retourné immédiatement.
    // $a $b $c représente le même objet issue de la classe Singleton 

    // De cette manière, il est impossible de créer plusieurs objets de type Singleton 

    // Nous avons donc, grâce au pattern Singleton, réussi à créer une instance unique de cette classe 

    // Un Singleton est composé au minimum de 3 caractéristiques :
        // - Un attribut privé et statique qui conservera l'instance unique de la classe
        // - Un constructeur privé afin d'empêcher la création d'objet depuis l'extérieur de la classe
        // - Une méthode statique qui permet soit d'instancier la classe soit de retourner l'unique instance créée.


*/
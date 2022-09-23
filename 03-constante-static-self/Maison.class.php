<?php 

class Maison 
{
    public $couleur = "blanc";  // Une propriété qui appartient à l'objet
    public static $espaceTerrain = "500m²"; // Une propriété statique appartient à la classe et non pas à l'objet (n'appartient pas aux instances de cette classe), c'est pas changeable ni appelable sur l'objet
    const HAUTEUR = "10m"; // Déclaration d'une constante qui appartient à la classe et non pas à ses instances, par défaut la constante est public

    private static $nbPiece = 7; // Une propriété statique mais privée, impossible de l'appeler depuis l'extérieur... J'ai besoin d'un setter et getter
    private $nbPorte = 10;

    public static function setNbPiece($nbr)
    {
        self::$nbPiece = $nbr;
        // self:: représente la classe à l'intérieur d'elle même 
        // On set l'information de la propriété private
    }

    public static function getNbPiece()
    {
        return self::$nbPiece;
    }

    public function getNbPorte()
    {
        return $this->nbPorte;
        // Ici on utilise $this comme vu dans le chapitre précédent car la propriété nbPorte n'est pas static, donc elle appartient à l'objet
    }
}

echo "Espace terrain : " . Maison::$espaceTerrain . "<hr>"; // Avec les :: on peut appeler des propriétés/méthodes de la classe sans avoir instancié d'objet
Maison::$espaceTerrain = '600m²';
echo "Espace terrain après modif : " . Maison::$espaceTerrain . "<hr>"; 
echo "Hauteur de la maison : " . Maison::HAUTEUR . "<hr>";
// Maison::HAUTEUR = 50; // Ne fonctionne pas, c'est une constante on ne peut plus la modifier par la suite (à modifier uniquement dans sa déclaration)

Maison::setNbPiece(8);
echo "Nouveau nombre de pièce dans la maison : " . Maison::getNbPiece() . "<hr>";

$maison1 = new Maison;
// echo $maison1->couleur;

// echo "<pre>";
// print_r($maison1);
// echo "</pre>";
// Maison Object
// (
//     [couleur] => blanc
// )

// PHP est permissif sur l'orienté objet, faisons quelques tests :
    // echo $maison1->espaceTerrain . '<hr>';  ERREUR, pas possible d'appeler une propriété static d'une classe via un objet
    // echo Maison::$couleur;  // ERREUR pas possible d'appeler une propriété non static via la class (car appartient à l'objet, donc, après son instanciation)
    // echo Maison::getNbPorte(); // ERREUR, je ne peux pas appeler une méthode appartenant à l'objet, via la classe
    // echo $maison1->getNbPiece(); // PAS D'ERREUR, ici php est permissif, ATTENTION, il devrait donner une erreur, on tente d'appeler sur un objet, une méthode statique (avec l'opérateur objet ->) donc appartenant à la classe et non pas à l'objet, ce n'est pas possible 
    // echo $maison1::$espaceTerrain; // PAS D'ERREUR, ici php est très permissif, devrait donner une erreur, la syntaxe est completement incohérente avec sur un objet mais en utilisant l'opérateur ::  et en poitant sur une propriété statique...

    // On utilisera JAMAIS ce genre de syntaxe incohérente

    /******************************************** 
     
    // On utiliserait la notion static pour regrouper des "fonctions" sous forme de "méthodes" par thème (le nom de notre classe)
    class Date {
        public static function dateFr($date) {
            date("j/m/Y", strtotime($date));
        }
        public static function dateUs($date) {
            date("m/j/Y", strtotime($date));
        }
    }

    if(nationalite=="fr") {
        Date::dateFr($date);
    }


    -----------------------------------------------

    Rappel de syntaxe : 
    -----------------------
        $objet->element      = un element d'un objet après une instanciation (à l'extérieur de la classe)
        $this->element       = un element d'un objet à l'INTERIEUR de la classe 

        Class::element       = un element (static) d'une classe à l'extérieur de la classe 
        self::element        = un element (static) d'une classe à l'intérieur d'elle même

        2 questions à se poser pour retrouver l'info :
            - Est-ce que c'est static ?
                - Si oui (self::, Class::)
                    - Est-ce que c'est à l'intérieur de la classe ?
                        - Si oui, self::
                        - Si à l'extérieur, Class::
                - Si non static ($objet-> ,   $this->)
                    - Est ce que c'est à l'intérieur de la classe ?
                        - Si oui, $this-> 
                        - Si à l'extérieur, $objet-> 

        static indique qu'un élément appartient à la classe (et non pas à l'objet) :
            - Si c'est une propriété, on pourra la modifier
            - Si c'est une constante, on ne peut pas la redéfinir

        Const et Static :
            - Les deux appartiennent à la classe


            - Const permet de déclarer une constante dans une classe en orienté objet
            - define() permet de déclarer une constante dans l'espace global en procédural

        self représente la classe à l'intérieur d'elle même
        $this représente l'objet en cours d'utilisation à l'intérieur de la classe

        Lorsque l'on appelle une propriété via l'objet, i ne faut pas mettre le signe $ devant   $objet->propriete 
        Lorsque l'on appelle une propriété static via la class, il faut mettre le $ devant Class::$propriete



     */
<?php

class A
{
    public function direBonjour()
    {
        return "Bonjour";
    }
}

// ---------------------------------

class B // pas d'héritage ici
{
    public $mavariable;
    public function __construct()
    {
        $this->mavariable = new A; // Je créé un objet A que je place dans l'attribut $mavariable de mon objet B 
    }

    public function uneMethode()
    {
        return $this->mavariable->direBonjour();
        // je peux appeler des méthodes de A dans mon objet B à l'intérieur de ma classe aussi en passant par $this qui représente l'objet B
        // on mets une sucession de flèche, pour atteindre l'objet de deuxieme niveau, un peu comme dans un tableau array multidimensionnel dans lequel on met une succession de crochets.
    }
}

$b = new B;
echo "<pre>";
print_r($b);
echo '</pre>';

echo "<pre>";
print_r(get_class_methods($b));
echo '</pre>';
//   B       A
echo $b->mavariable->direBonjour();
// C'est ainsi un objet dans un objet, pas d'héritage 


// $a = new A;
// echo $a->direBonjour();

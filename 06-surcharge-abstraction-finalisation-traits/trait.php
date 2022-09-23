<?php 

trait TPanier 
{
    private $nbProduit = 5;
    public function affichageProduits()
    {
        return "Affichage des produits<hr>";
    }
}

trait TMembre 
{
    public function affichageMembres()
    {
        return "Affichage des membres<hr>";
    }
}

// $panier = new TPanier; // Impossible d'instancier un trait 

class Site
{
    use TPanier, TMembre; // Importation des traits déclarés ci-dessus via le mot clé 'use'
}

$site = new Site;

echo "<pre>";
print_r($site);
echo "</pre>";
echo "<pre>";
print_r(get_class_methods($site));
echo "</pre>";

// Site Object
// (
//     [nbProduit:Site:private] => 5
// )
// Array
// (
//     [0] => affichageProduits
//     [1] => affichageMembres
// )

// echo "Nombre de produits dans le panier : $site->nbProduit<hr>";
echo $site->affichageMembres();
echo $site->affichageProduits();

/*  

    Les traits ont été inventés pour repousser les limites de l'héritage
    Une classe ne peut hériter que d'une seule autre classe à la fois.
    Cependant, elle peut importer plusieurs traits à la fois.
    Un trait est un regroupement de méthodes et propriétés pouvant être importées dans une classe.

    Petit détail, contrairement à l'héritage on va récupérer également les éléments de visibilité "private" !

    Attention, impossible d'instancier un trait, et on l'importe uniquement avec le mot clé use
*/

// Un trait peut utiliser un autre trait :

trait A 
{
    public function a()
    {
        return "a";
    }
}

trait B 
{
    use A;
    public function b()
    {
        return "b";
    }
}

class Test 
{
    use B;
}

$objet = new Test;
echo '<pre>';
echo print_r(get_class_methods($objet));
echo '</pre>';


// Si une classe redéclare une méthode venant d'un trait, alors cela écrase la méthode du trait et impossibilité de la récupérer (contrairement à l'héritage dans lequel on a l'option du parent::)

trait MonTrait
{
    public function DireBonjour()
    {
        echo "Hello!";
    }
}

class MaClasse
{
    use MonTrait;

    public function DireBonjour()
    {
        echo "Bonjour !<hr>";
    }
}

$objet = new MaClasse;
$objet->DireBonjour();

// Il est possible de renommer/donner un alias à une méthode d'un trait

trait F 
{
    public function hello()
    {
        echo "Hello<hr>";
    }
}

class MyClass
{
    use F
    {
        hello as bonjour;
    }
}

$o = new MyClass;
$o->hello(); // Affiche Hello<hr>
$o->bonjour(); // Affiche Hello<hr>
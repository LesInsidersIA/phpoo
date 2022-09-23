<?php 

// Surcharge ou Override : une redéfinition d'une methode dont on a hérité, on peut soit écraser totalement son comportement, soit se servir éventuellement du résultat de la méthode héritée pour y apporter un traitement complémentaire 

class A 
{
    public function calcul()
    {
        return 2506;
    }
}

class B extends A 
{
    public function calcul() // je redéfini ma méthode, je surcharge ma méthode
    {
        // Je vais apporter un traitement complémentaire à mon résultat de calcul de la classe parent
        $nb = parent::calcul(); // 10
        // Ici on appelle la fonction de la classe mère via le mot clé parent:: 
        // On indique qu'on veut stocker le résultat de calcul dans $nb
        // On utilise pas $this->calcul() sinon elle serait récursive (elle s'appelerait en boucle)

        if ($nb <= 100)
        return "Le résultat de calcul d'origine est inférieur ou égal à 100<hr>";
        else 
        return "Le résultat de calcul d'origine est supérieur à 100<hr>";

    }

    public function autreCalcul()
    {
        $nb = parent::calcul(); // Il est possible d'atteindre une méthode de mon parent dans une méthode qui n'est pas forcement surchargée

        if ($nb <= 10000)
        return "Le résultat de calcul d'origine est inférieur ou égal à 10000<hr>";
        else 
        return "Le résultat de calcul d'origine est supérieur à 10000<hr>";
    }
}

$testB = new B;
echo $testB->calcul();
echo $testB->autreCalcul();
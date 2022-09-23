<?php 
/* 

    1. Faire en sorte de ne pas avoir d'objet Vehicule (abstract sur class Vehicule)
    2. Obligation pour la Renault et la Peugeot de démarrer() EXACTEMENT de la même façon (final sur la méthode demarrer)
    3. OBLIGATION pour la Renault de déclarer un carburant diesel et pour la Peugeot de déclarer un carburant essence (abstract sur la methode carburant)
    4. La Renault doit effectuer 30 tests de plus qu'un véhicule de base 
    5. La Peugeot doit effectuer 70 tests de plus qu'un véhicule de base
    6. Instanciez, testez


*/

abstract class Vehicule 
{
    final public function demarrer()
    {
        return "je démarre";
    }

    abstract public function carburant();
    
    public function nombreDeTestObligatoire()
    {
        return 100;
    }
}

class Peugeot extends Vehicule
{
    public function carburant() 
    {
        return "essence";
    }

    public function nombreDeTestObligatoire()
    {
        $testP = parent::nombreDeTestObligatoire();
        $testP += 70;
        return $testP;
        // return parent::nombreDeTestObligatoire() + 70;
    }
}

class Renault extends Vehicule 
{
    public function carburant() 
    {
        return "diesel";
    }

    public function nombreDeTestObligatoire()
    {
        $testP = parent::nombreDeTestObligatoire();
        $testP += 30;
        return $testP;
    }
}
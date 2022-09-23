<?php 

// une interface n'est ni une classe, ni un trait, c'est un nouveau type

interface Mouvement
{
    public function deplacement();
}
#############################################

class Bateau implements Mouvement 
{
    public function deplacement() 
    {

    }
}

/*  

    - Une interface est une liste de méthodes (sans contenu) qui permet de garantir que toutes les classes qui implémentent l'interface contiennent exactement ces mêmes méthodes.
    - L'interface me sert à représenter un point commun entre plusieurs éléments
    - Un bateau et un avion se déplace tous les deux, mais pas forcément de la même façon, (le bateau vogue, l'avion vole).
    - C'est une contrainte qu'on impose aux développeurs, dans le cadre de développement d'un nouveau véhicule, on obligera à implémenter l'interface Mouvement 
    - Dans une interface on ne peut avoir que des méthodes (elles doivent être forcément public), pas de propriétés ! 

    Syntaxe :
        class extends class => héritage
        class implement interface  =>  implémentation d'interface
        class { use trait; } => l'importation d'un trait 

        // Il est possible d'avoir un héritage, en plus de plusieurs implémentations d'interface en plus de plusieurs importations de traits

*/
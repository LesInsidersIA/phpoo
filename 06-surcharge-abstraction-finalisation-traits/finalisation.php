<?php 

final class Application 
{
   public function lancementApplication()
    {
        return "Je lance l'appli comme ça ! <hr>";
    }
}

// class Extension extends Application {} // ATTENTION ! Il n'est pas possible d'hériter d'une classe finale !
// Une classe finale a pour but d'être FINALE, afin qu'elle ne soit plus modifiable par la suite, elle a été prévue pour être utilisée telle quelle

// Il est tout de même possible d'instancier et manipuler une classe finale
$app = new Application;
echo $app->lancementApplication();

class Application2 
{
    final public function lancementApplication2()
    {
        return "L'appli se lance AUSSI comme ça !<hr>";
    }
}

class Extension2 extends Application2 
{
    // On hérite sans problèmes de la méthode finale lancementApplication2()
    // public function lancementApplication2() {} 
    // Par contre, impossible de surcharger une méthode finale
}

$ext = new Extension2;
echo '<pre>';
print_r(get_class_methods($ext));
echo '</pre>';
echo $ext->lancementApplication2();

/*  

    - Une classe finale ne peut pas être héritée
    - Une classe finale aura forcément des méthodes qui ne pourront pas être surchargées ou redéfinies (forcement je ne peux pas en hériter... Pas d'intérêt de rajouter le mot final aux méthodes d'une classe déjà finale)
    - Une classe finale reste instanciable
    - Une méthode finale peut être présente dans une classe normale
    - Par contre, la méthode finale, dans une classe normale sera vérouillée afin d'empêcher toute sous-classe de la surcharger/redéfinir/changer son comportement (afin d'être sûr que le comportement défini en amont soit préservé après l'héritage)


*/
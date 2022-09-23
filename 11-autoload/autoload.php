<?php 
                            // récupère le nom de la classe
function inclusionAutomatique($nomDeLaClasse)
                            // Alphabet\E
{
    echo "Salut, je suis dans l'inclusionAutomatique : la classe qui a été demandée est la classe : $nomDeLaClasse<hr>";

            // <a href="Alphabet/E.class.php"></a>
                //  Alphabet\E.class.php
    require_once(str_replace('\\','/',$nomDeLaClasse . '.class.php'));
    echo "require_once(" . __DIR__ . '/' .str_replace('\\','/',$nomDeLaClasse . '.class.php') . ")<hr>";
}

spl_autoload_register('inclusionAutomatique');

// $a = new A;
// $b = new B;
// // $x = new X;
// $c = new C;
// $d = new D;

/* 

    spl_autoload_register() : Est une fonction prédéfinie qui permet d'executer une fonction choisie entre les parenthèses, lorsque l'interpreteur comprends la creation d'un nouvel objet dans le code (en gros dès qu'il voit un 'new').
    Le nom à côté du 'new' (namespace\classe) est récupéré et automatiquement transmit en argument de la fonction inclusionAutomatique
    INDISPENSABLE de respecter une convention de nommage sur ses fichiers de classe pour que l'autoload fonctionne correctement

    l'autoload permet d'automatiser l'inclusion des fichiers contenant les classes, plus besoin de se préocuper de faire les include/require des classes dont on aurait besoin, c'est l'autoload qui se charge de le faire à notre place

*/
<?php

class Autoload
{
                                        //controller\Controller
 // le namespace sert à rentrer dans le dossier et la classe Controller sert à appeler le fichier php pour le require, on profite de la regle de nommage
    public static function inclusionAuto($className) // static pour ne pas pouvoir y acceder depuis un objet
    {
        // str_replace() : fonction prédéfinie qui permet ici de remplacer les '\' par des '/' afin de définir le bon chemin

        // le double anti-slash '\\' permet d'échapper le quote


        // require_once D:\xampp\htdocs\PHPOO1\12-CRUD/controller/Controller.php
        require_once __DIR__ . '/' . str_replace('\\', '/', $className . '.php'); // le but de passer par la constante magique est de rendre mon code adaptable au plus possible lorsque j'update en ligne, change de projet etc


        // Affichage du chemin sur la page web pour controle
        // echo __DIR__ . '/' . str_replace('\\', '/', $className . '.php<br>');
    }
}

spl_autoload_register(array('Autoload', 'inclusionAuto'));

/*

    spl_autoload_register() : fonction prédéfinie qui s'execute lorsque l'interpréteur voit passer le mot clé "new"
    Lorsque l'on instancie une classe, la fonction 'inclusionAuto' de la classe 'Autoload' s'execute automatiquement et tout ce qu'il y a après le 'new' (namespace\class) est envoyé directement en argument de la fonction 'inclusionAuto'
    On se sert du namespace 'controller' pour entrer dans le dossier controller du dossier '11-CRUD' et du nom de la classe 'Controller' pour inclure le fichier Controller.php
    Il faut bien respecter une convention de nommage pour les dossiers et les fichiers 

*/


// Comment faire pour instancier ma class controller ? new controller; et voyons le comportement, je passe dans spl autoload dans class autoload et tu lance inclusion auto


// CI DESSOUS TEST DU BON FONCIONNEMENT DE l'AUTOLOAD ET DU CHEMIN DACCES
// $c = new controller\Controller;
// echo '<pre>'; print_r($c); echo '</pre>';

// echo __DIR__ . '/controller/Controller.php<br>';
// echo __DIR__;
<?php

// On require l'autoload afin d'avoir le require automatique de tous mes appels
require_once('autoload.php');


// On instancie le controller et voyons ce qu'il se passe
$controller = new controller\Controller;
// echo '<pre>'; print_r($controller); echo '</pre>'; // TEST de la récupération de l'objet controller

$controller->handleRequest();
<?php 

//le but de l'autoload est d'éviter de faire des require/include à la main comme ci après
// require_once('A.class.php');
// require_once('B.class.php');
// require_once('C.class.php');
// require_once('D.class.php');

require_once('autoload.php');

$a = new A;
$b = new B;
$c = new C;
$d = new D;

$e = new Alphabet\E;
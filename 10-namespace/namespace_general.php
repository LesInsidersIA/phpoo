<?php 

namespace General; 

// Les namespace (espace de nom) permettent de ranger ses classes
// Il est possible que 2 classes possèdent le même nom mais proviennent de namespace différents, de ce fait, il n'y aura pas de conflits entre ces deux classes. 
// Dans le cas d'un travail collaboratif en équipe, cela evitera les collisions si l'on nomme les classes ou fonctions de la même façon
// Ainsi en OO, on essaiera d'utiliser au maximum les namespaces

require('namespace_commerce.php');

// permet de dire quel namespace je souhaite importer du fichier namespace_commerce.php
use Commerce1, Commerce2, Commerce3;

echo __NAMESPACE__ . '<hr>'; // Constante magique permettant de voir dans quel namespace je me trouve, ici, General 

$pdo = new \PDO('mysql:host=localhost;dbname=entreprise', 'root', '');
// Sans l'anti-slash, cela recherche la classe PDO dans le namespace General, dans un namespace, on est en quelque sorte à l'extérieur de l'espace global de php
// l'antislash me permet de revenir un niveau en arrière, donc dans l'espace global d'origine de php et il retrouve PDO, LE TEMPS DE LA LIGNE

$commande = new Commerce1\Commande; // Syntaxe pour piocher dans un namespace appelé par use, ici instanciation d'un objet de la classe Commande venant du namespace Commerce1
echo '<pre>'; print_r($commande); echo '</pre>';
echo "Nombre de commandes : " . $commande->nbCommande . '<hr>';

$produit1 = new Commerce2\Produit; 
$produit2 = new Commerce3\Produit;

echo '<pre>'; print_r($produit1); echo '</pre>';
echo '<pre>'; print_r($produit2); echo '</pre>';
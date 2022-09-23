<?php

// echo '<pre>'; print_r(get_declared_classes()); echo '</pre>';

// --------------------------------------------------
// --------------------------------------------------
// --------------------------------------------------
// --------- PDO : PHP DATA OBJECT
// --------------------------------------------------
// --------------------------------------------------
// --------------------------------------------------
// https://www.php.net/manual/en/class.pdo
// https://www.php.net/manual/en/class.pdostatement.php

/* 

    query() :
    ----------
    - Pour lancer tout type de requete 
        Echec :
        -------
            - Erreur de syntaxe dans la requete
        Succes :
        -------
            - Je vais récupérer un objet PDOStatement (qui représente la réponse de ma requête)

    prepare() :  A PRIVILEGIER POUR LA SECURITE
    -----------
    - Pour lancer tout type de requete
    - Avec prepare() on "prépare" d'abord notre requête, on obtient directement un objet PDOStatement (mais la requete n'est pas encore exécutée)
    - On peut ensuite exécuter la requête préparée avec la methode execute()
        Echec :
        -------
            - Erreur de syntaxe dans la requete
        Succes :
        -------
            - Je vais récupérer un objet PDOStatement (qui représente la réponse de ma requête)

    */

echo "<h2>01 - Connexion à la BDD</h2>";

// Pour nous connecter à notre BDD, il nous suffit d'instancier un objet de la classe PDO
// L'objet créé représentera le lien avec notre BDD
// Pour créer cet objet, nous avons besoin de 4 informations :
// - le serveur (local : localhost)
// - login de connexion à la bdd (root)
// - mdp de connexion à la bdd (rien, ou sur mamp c'est root)
// - le nom de la bdd 
// + de façon optionnelle, des options pour gérer les modes d'erreur et l'encodage

$host = 'mysql:host=localhost;dbname=entreprise'; // hote + bdd 
$login = 'root'; // login de connexion à la bdd
$password = ''; // mdp de connexion à la bdd
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // gestion des erreurs
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // on force l'utf8 sur les données provenants de la bdd
);

$pdo = new PDO($host, $login, $password, $options);

echo '<pre>';
print_r($pdo); // pas de propriétés dans PDO
echo '</pre>';

// echo '<pre>';
// print_r(get_class_methods($pdo)); // les méthodes de PDO
// echo '</pre>';

echo "<h2>02 - Requete de type action (INSERT / UPDATE / DELETE)</h2>";

// Enregistrement d'un nouvel employé dans la BDD entreprise tables employes 

// INSERT INTO employes (id_employes, prenom, nom, salaire, sexe, date_embauche, service) VALUES (NULL, 'Jack', 'Sparrow', 2000, 'm', CURDATE(), 'piraterie')

// $reponse = $pdo->query("INSERT INTO employes (id_employes, prenom, nom, salaire, sexe, date_embauche, service) VALUES (NULL, 'Jack', 'Sparrow', 2000, 'm', CURDATE(), 'piraterie')");

// $reponse est un objet PDOStatement, il représente la réponse à ma requête.
// Pour une requête de type action, il n'y a pas vraiment de réponse, cependant il est possible de demander le nombre de ligne impactées par la requête 
// echo "Nombre de lignes impactées par la requête insert into : " . $reponse->rowCount() . '<hr>';

echo "<h2>03 - SELECT pour une seule ligne de résultat</h2>";

// On va sélectionner l'employé numéro 990
// SELECT * FROM employes WHERE id_employes = 990
// Réponse MySQL dans la console :
// +-------------+-----------+--------+------+-----------+---------------+---------+
// | id_employes | prenom    | nom    | sexe | service   | date_embauche | salaire |
// +-------------+-----------+--------+------+-----------+---------------+---------+
// |         990 | Stephanie | Lafaye | f    | assistant | 2017-03-01    |    1775 |
// +-------------+-----------+--------+------+-----------+---------------+---------+

$reponse = $pdo->query("SELECT * FROM employes WHERE id_employes = 990");

// echo '<pre>';
// print_r($reponse);
// echo '</pre>';
// echo '<pre>';
// print_r(get_class_methods($reponse));
// echo '</pre>';

// En l'état, la réponse de la BDD est inexploitable
// Pour la rendre exploitable via PHP, il faut transformer la ligne et on utilisera ici la méthode fetch()

// La méthode fetch() possède plusieurs modes de fonctionnement que voici :

// FETCH_ASSOC : pour un tableau array associatif (le nom des colonnes comme indice du tableau array)
$donnees = $reponse->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($donnees);
echo '</pre>';
//     Array
// (
//     [id_employes] => 990
//     [prenom] => Stephanie
//     [nom] => Lafaye
//     [sexe] => f
//     [service] => assistant
//     [date_embauche] => 2017-03-01
//     [salaire] => 1775
// )

// FETCH_NUM : pour un tableau array indexé numériquement
// $donnees = $reponse->fetch(PDO::FETCH_NUM);
// echo "<pre>";
// print_r($donnees);
// echo '</pre>';
// Array
// (
//     [0] => 990
//     [1] => Stephanie
//     [2] => Lafaye
//     [3] => f
//     [4] => assistant
//     [5] => 2017-03-01
//     [6] => 1775
// )

// FETCH_BOTH : Cas par défaut si non précisé dans l'argument de fetch() (dans les réglages par défaut de votre serveur) : Mélange de FETCH_ASSOC et FETCH_NUM 
// $donnees = $reponse->fetch();
// ou
// $donnees = $reponse->fetch(PDO::FETCH_BOTH);
// echo "<pre>";
// print_r($donnees);
// echo '</pre>';

// FETCH_OBJ : Pour obtenir un nouvel objet avec les colonnes comme propriétés publiques de l'objet
// $donnees = $reponse->fetch(PDO::FETCH_OBJ);
// echo "<pre>";
// print_r($donnees);
// echo '</pre>';
// stdClass Object
// (
//     [id_employes] => 990
//     [prenom] => Stephanie
//     [nom] => Lafaye
//     [sexe] => f
//     [service] => assistant
//     [date_embauche] => 2017-03-01
//     [salaire] => 1775
// )

// on affiche Stephanie
echo $donnees['prenom'] . '<br>'; // avec FETCH_ASSOC ou FETCH_BOTH
// echo $donnees[1] . '<br>';        // avec FETCH_NUM ou FETCH_BOTH
// echo $donnees->prenom . '<br>';   // avec FETCH_OBJ 

// Une ligne traitée avec fetch n'existe plus dans la réponse, après un fetch la ligne est "consommée" et il n'est plus possible de revenir dessus à moins de refaire une requete

echo "<h2>04 - SELECT pour plusieurs lignes de résultat</h2>";

$reponse = $pdo->query("SELECT * FROM employes");

// Pour connaitre le nombre de lignes récupérées par la requete : rowCount()
echo "Nombre d'employés : " . $reponse->rowCount() . '<hr>';

// $donnees = $reponse->fetch(PDO::FETCH_ASSOC); // ici on récupère JP Laborde, 1ere ligne
// echo "<pre>";
// print_r($donnees);
// echo '</pre>';
// $donnees = $reponse->fetch(PDO::FETCH_ASSOC); // ici on récupère Clément Gallet, 2eme ligne
// echo "<pre>";
// print_r($donnees);
// echo '</pre>';
// etc etc, chaque fetch passe sur une ligne à la fois

// Pour traiter plusieurs lignes ? Une boucle ! 

while ($ligne = $reponse->fetch(PDO::FETCH_ASSOC)) {
    // echo "<pre>";
    // print_r($ligne);
    // echo '</pre><hr>';
}
// Il n'est pas possible de revenir sur une ligne déjà traitée, elle est consommée
// Si on veut manipuler plusieurs fois le même résultat, il faudra refaire la requete
$reponse = $pdo->query("SELECT * FROM employes");
echo '<div style="display:flex; flex-wrap: wrap; justify-content: start">';
while ($ligne = $reponse->fetch(PDO::FETCH_ASSOC)) {
    echo '<div style="margin: 20px; padding: 1%; width: 15%; background-color:teal; color: white">';
    echo "ID : " . $ligne['id_employes'] . '<br>';
    echo "Prénom : " . $ligne['prenom'] . '<br>';
    echo "Nom : " . $ligne['nom'] . '<br>';
    echo "Service : " . $ligne['service'] . '<br>';
    echo "Salaire : " . $ligne['salaire'] . '<br>';
    echo "Sexe : " . $ligne['sexe'] . '<br>';
    echo "Date d'embauche : " . $ligne['date_embauche'] . '<br>';
    echo '</div>';
}
echo '</div>';

echo "<h2>05 - SELECT pour plusieurs lignes de résultat affichées dans un tableau html qui s'adapte à n'importe quelle requete</h2>";

$reponse = $pdo->query("SELECT * FROM employes");

// En écrivant les entêtes de colonnes nous même (script pas totalement automatique)
echo "<style>th , td {padding:10px;}</style>";
echo '<table border="1" style="border-collapse : collapse; width:100%;">';

echo '<tr>';
echo '<th>Id employés</th>';
echo '<th>Prénom</th>';
echo '<th>Nom</th>';
echo '<th>Sexe</th>';
echo '<th>Service</th>';
echo '<th>Date embauche</th>';
echo '<th>Salaire</th>';
echo '</tr>';

while ($ligne = $reponse->fetch(PDO::FETCH_ASSOC)){
    echo '<tr>';
    foreach($ligne as $indice => $valeur)
    {
        echo "<td>$valeur</td>";
    }
    echo '</tr>';
}

echo '</table><hr><hr><hr>';

$reponse = $pdo->query("SELECT * FROM employes");
// Avec un script qui s'adaptera à n'importe quelle requête et qui va gérer tout seul la créations des bons entêtes de mon tableau
// columnCount() : méthode de PDOStatement qui nous renvoie le nombre de colonne dans la réponse
// https://www.php.net/manual/en/pdostatement.columncount.php
// getColumnMeta($arg) : méthode de PDOStatement qui nous renvoie les informations (les metadata) de la colonne, notamment, un indice "name"
// echo $reponse->columnCount();
// echo '<pre>';
// print_r($reponse->getColumnMeta(0));
// echo '</pre>';
echo '<table border="1" style="border-collapse : collapse; width:100%;">';
echo '<tr>';
for ($i = 0; $i < $reponse->columnCount(); $i++){
    $infos_colonne = $reponse->getColumnMeta($i);
    echo '<th>' . ucfirst(str_replace('_',' ',$infos_colonne['name'])) . '</th>';
}
echo '</tr>';
while ($ligne = $reponse->fetch(PDO::FETCH_ASSOC)){
    echo '<tr>';
    foreach($ligne as $indice => $valeur)
    {
        echo "<td>$valeur</td>";
    }
    echo '</tr>';
}
echo '</table>';

// echo '<td>' . implode($ligne, '</td><td>') . '</td>';

echo "<h2>EXERCICE : récupérez les prénoms et noms des employés de la BDD pour les afficher dans une liste ul li</h2>";

$reponse = $pdo->query("SELECT * FROM employes");

echo '<ul><li>Nom - Prenom</li>';
while ($valeurs = $reponse->fetch(PDO::FETCH_ASSOC))
{
    echo '<li>' . $valeurs['nom'] . ' - ' . $valeurs['prenom'] . '</li>';
}
echo '</ul>';

$reponse = $pdo->query("SELECT prenom, nom FROM employes");

echo '<ul>';
while ($employe = $reponse->fetch(PDO::FETCH_ASSOC))
{
   foreach($employe as $indice => $valeur){
        if ($indice == 'prenom') echo "<li>$valeur ";
        else echo "$valeur </li>";
   }
}
echo '</ul>';

echo '<h2>06 - SELECT pour plusieurs lignes de résultat avec fetchAll()</h2>';
// fetch() permet de traiter une seule ligne à la fois
// fetchAll() traite toutes les lignes en une seule fois sauf que l'on obtient un tableau array multidimensionnel (à plusieurs niveaux)

$reponse = $pdo->query("SELECT * FROM employes");

$listeEmployes = $reponse->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';
print_r($listeEmployes);
echo '</pre>';

// EXERCICE : affichez les prénoms des employés dans une liste ul li 

echo 'Avec foreach : <ul>';
    foreach($listeEmployes as $sousTableau)
    {
        echo '<li>' . $sousTableau['prenom'] . '</li>';
    }
echo '</ul><hr>';

echo "Avec for : <ul>";
for ($i = 0; $i < count($listeEmployes); $i++)
{
    echo '<li>' . $listeEmployes[$i]['prenom'] . '</li>';
}
echo '</ul>';

echo "<h2>07 - prepare() + bindParam() + execute() Pour sécuriser nos requêtes !</h2>";

// Si dans la requete une ou des informations proviennent d'un utilisateur, OBLIGATOIRE de faire un prepare()
// prepare() permet de sécuriser les requêtes pour éviter les injections SQL


$nom = 'laborde'; // Information que l'on imagine avoir récupérée depuis un formulaire
                    // l'utilisateur recherche un employé selon son nom

// On commence par préparer la requête :
$reponse = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
// Lors de la préparation de la requête, on ne met pas directement la variable récupérée !
// On représente dans la requête une information attendue via un "marqueur nominatif", ce marqueur est représenté grâce aux ":"
// Un marqueur nominatif représente une variable dans la requete, que l'on assignera plus tard. On dit ici à la requete "il manque une info ! Nous allons la fournir avec bindParam()"
// bindParam() permet de donner la valeur attendue au marqueur nominatif
// une ligne de bindParam() par marqueur !

// On donne la valeur attendue :
$reponse->bindParam(':nom', $nom, PDO::PARAM_STR);
// PDO::PARAM_STR pour appliquer un filtre qui transforme la saisie en string (avec MySQL on peut toujours transmettre au format string)

// Maintenant que l'information attendue est fournie à la requête, on peut l'exécuter
// S'il y avait une erreur sur tout le processus depuis la preparation, en passant par les bindparam, jusqu'au execute, l'erreur surviendrai forcément à la même ligne que le execute()
$reponse->execute();

$donnees = $reponse->fetch(PDO::FETCH_ASSOC);
echo '<pre>';
print_r($donnees);
echo '</pre>';



<?php 

function recherche($tab, $elem)
{
    if(!is_array($tab))
        throw new Exception('Vous devez envoyer un ARRAY !');

    if (sizeof($tab) == 0)
        throw new Exception('Votre tableau est vide !');
        // throw permet d'instancier la classe prédéfinie Exception, ce qui nous permet de sortir de l'espace local de la function recherche et de récupérer l'objet Exception dans le bloc catch 
        // Si on faisait $e = new Exception, on ne serait pas envoyer dans le bloc catch et $e existerait seulement dans l'espace local de notre fonction 

    $position = array_search($elem, $tab); // Fonction cherchant le numéro d'une entrée dans un tableau array
    return $position;
}

$tab1 = array();
$tab2 = 5;
$tabPerso = ['Mario', 'Luigi', 'Peach', 'Toad', 'Yoshi'];
echo '<pre>';
print_r($tabPerso);
echo '</pre>';
// Array
// (
//     [0] => Mario
//     [1] => Luigi
//     [2] => Peach
//     [3] => Toad
//     [4] => Yoshi
// )

echo "Mario se trouve à la position : " . recherche($tabPerso, 'Mario') . '<hr>';
echo "Yoshi se trouve à la position : " . recherche($tabPerso, 'Yoshi') . '<hr>';
// echo recherche($tab1, 'Mario');
// echo recherche($tab2, 'Toad');  // Si j'exécute ici ma fonction recherche et que je tombe dans un cas d'erreur, je reçois une fatal error avec une "uncaught Exception", exception non attrapée

try // C'est un bloc d'essai, on va tenter d'exécuter du code, si une erreur est rencontrée, on sort du bloc try et le code de notre page continue de s'exécuter... 
    // Si jamais l'erreur lançait une exception (comme dans notre function avec le throw new Exception), alors on arrive dans le bloc catch et tout le code du bloc catch s'exécutera 
    // Cela nous permet d'avoir une gestion plus propre de nos cas d'erreur en évitant les fatal error prédéfinie dans php 
{
    echo "On commence le bloc try<hr>";
    echo "Peach se trouve à la position : " . recherche($tabPerso, 'Peach') . '<hr>';
    // echo recherche($tab1, 'Mario');
    echo recherche($tab2, 'Toad'); // Erreur -> Cela nous sort du bloc try
    echo "ne s'affiche pas si je suis sorti du try";
}

catch(Exception $e) // Exception, classe prédéfinie de php, je catch ici dans $e l'exception qui a été lancé dans la fonction recherche()
// catch et try fonctionne toujours de pair
{
    // echo '<pre>';
    // print_r($e); // Contient plusieurs propriétés toutes private ou protected
    // echo '</pre>';
    // echo '<pre>';
    // print_r(get_class_methods($e)); // Contient essentiellement des getter me permettant de récupérer les propriétés en lien avec les détails de l'erreur déclenchée
    // echo '</pre>';
    // echo "Coucou je t'ai catch !<hr>";
    echo "Erreur : " . $e->getMessage() . " dans le fichier : " . $e->getFile() . " à la ligne " . $e->getLine() . "<hr>";
    echo "<pre>";
    print_r($e->getTrace());
    echo '</pre>';
}
echo "Après le try catch<hr>";

############################################################

    // le meme genre de classe existe spécifiquement pour PDO, PDOException 

    // $pdo = new PDO('mysql:host=localhost;dbname=entrprise', 'root', '');// Fatal error uncaught exception si je ne suis pas dans un bloc try
    try // on tente d'executer la connexion à la bdd avec un bloc d'essai try
    {
        $pdo = new PDO('mysql:host=localhost;dbname=entrprise', 'root', '');
        echo "Connexion réussie";
    }
    catch (PDOException $e) // Si la connexion n'a pas pu être établie dans le bloc try, PDO lance automatiquement une exception (de type PDOException) et on tombe dans le bloc catch
    // la classe PDOException contient les mêmes méthodes que la classe Exception tout court
    {
        echo "Connexion ratée";
    // echo '<pre>';
    // print_r($e); 
    // echo '</pre>';
    // echo '<pre>';
    // print_r(get_class_methods($e)); 
    // echo '</pre>';

    // echo $e->getTraceAsString();
    }


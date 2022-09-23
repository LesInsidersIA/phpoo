<?php 

function recherche($tab, $elem)
{
    if(!is_array($tab))
        die('Vous devez envoyer un array !'); // équivalent du throw new exception, sauf que là, on arrête tous les traitements
        // même chose pour exit('vous devez envoyer un array!');
       
    $position = array_search($elem, $tab); 
    return $position;
}

$liste = array('kiwi', 'melon', 'cerise');

    echo "position du melon : " . recherche($liste, 'melon') . '<hr>';
    echo recherche (123, 'kiwi'); // Cette ligne lance un die, la suite de ma page ne s'executera pas 

    echo "La suite de mon code... <hr><hr><hr>"; // On ne voit pas cette ligne elle ne s'execute pas car le code die à la ligne au dessus 

    /*  
        die/exit sont un peu équivalent à Exception, cela nous permet de lancer un message lorsqu'une erreur est rencontré, la différence est que nous n'avons pas la possibilité de manipuler l'erreur en question (contrairement à exception).

        Nous pouvons seulement afficher un message, et la suite du code ne s'EXECUTERA PAS ! 

        On utilise souvent die/exit pour ne pas afficher le contenu de notre page à un utilisateur qui aurait peut être tenté d'y acceder frauduleusement 

        par exemple, un utilisateur qui n'est pas admin, qui tente d'acceder à une page backoffice !  On fera une verification sur son statut de membre, s'il n'est pas admin, on redirige tout en lançant un die/exit (ce qui évite à l'utilisateur de pouvoir récupérer le contenu de notre page même si elle n'a pas été visible pour lui il pourra toujours la récupérer dans son historique)

    */


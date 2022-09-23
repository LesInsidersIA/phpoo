<?php 

for($i = 1; $i <= 10; $i++)
{
    
    ${"tour" . $i} = "On est dans le tour $i";
    // à chaque tour je créé une variable $tour1 $tour2 $tour3 etc en rapport au tour de boucle
}

echo $tour1 . '<br>';
echo $tour3 . '<br>';
echo $tour6 . '<br>';
echo $tour10 . '<br>';

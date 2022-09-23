<?php

/****************************** 
 
    -------------------------
    |       Vehicule        |
    -------------------------
    | $litresEssenceVhc     |
    -------------------------
    | setLitresEssenceVhc() |
    | getLitresEssenceVhc() |
    -------------------------

    -------------------------
    |       Pompe           |
    -------------------------
    | $litresEssencePmp     |
    -------------------------
    | setLitresEssencePmp() |
    | getLitresEssencePmp() |
    | donnerEssence($vhc)   |
    -------------------------

    1. Crééer les deux classes Vehicule et Pompe
    2. Implémenter les getters les setters... 
    3. Faites des tests en créant un vehicule contenant 5 litres d'essence
    4. Faites des tests en créant une pompe contenant 80 litres d'essence 
    5. Développement de la méthode donnerEssence() :
        Une pompe donne de l'essence à un vehicule en faisant forcement le plein d'essence qu'on considère être à 50.
        La fonction donnerEssence($vhc) prend donc en paramètre un objet de type Vehicule.
        On veut gérer les cas particuliers quand la pompe ne peut pas forcément faire le plein... 
 */

class Vehicule
{
    private $litresEssenceVhc;

    public function setLitresEssenceVhc($newLitres)
    {
        if (is_numeric($newLitres)) {
            $this->litresEssenceVhc = $newLitres;
        }
    }

    public function getLitresEssenceVhc()
    {
        return $this->litresEssenceVhc;
    }
}

class Pompe
{
    private $litresEssencePmp;

    public function setLitresEssencePmp($newLitres)
    {
        if (is_numeric($newLitres)) {
            $this->litresEssencePmp = $newLitres;
        }
    }

    public function getLitresEssencePmp()
    {
        return $this->litresEssencePmp;
    }

    public function donnerEssence(Vehicule $v) // on exige un argument de type vehicule
    {
        // 5
        $litresVhc = $v->getLitresEssenceVhc(); // ce qu'il reste dans le vhc
        // 80
        $litresPmp = $this->getLitresEssencePmp(); // ce qu'il reste dans la pompe
        // 3 possibilités
        // La pompe a assez d'essence pour faire le plein
        // La pompe n'a pas assez d'essence pour faire le plein, mais a quand même un peu d'essence à donner
        // La pompe est vide
        if (($litresPmp + $litresVhc) >= 50) { // Cas où j'ai assez pour faire le plein

            $this->setLitresEssencePmp($litresPmp - (50 - $litresVhc)); // je déduis des litres de la pompe, ce qu'il va falloir ajouter à mon vehicule pour faire le plein
            $v->setLitresEssenceVhc(50); // et je mets le plein à mon vehicule
        } elseif ($litresPmp == 0) { // cas où la pompe est vide
            echo "Désolé la pompe est vide<hr>"; // aucune opération, juste un echo "désolé"
        } else { // dernier cas, la pompe a de l'essence mais pas assez pour faire le plein
            $v->setLitresEssenceVhc($litresVhc + $litresPmp); // j'ajoute à la valeur d'essence actuellement dans le vehicule, la valeur d'essence de la pompe
            $this->setLitresEssencePmp(0); // je mets la pompe à 0
        }
    }
}

$vehicule1 = new Vehicule;
$vehicule1->setLitresEssenceVhc(5);
$vehicule2 = new Vehicule;
$vehicule2->setLitresEssenceVhc(8);
$vehicule3 = new Vehicule;
$vehicule3->setLitresEssenceVhc(10);
$pompe1 = new Pompe;
$pompe1->setLitresEssencePmp(80);
echo '<pre>';
print_r($vehicule1);
echo '</pre>';
echo '<pre>';
print_r($pompe1);
echo '</pre>';
$pompe1->donnerEssence($vehicule1);
echo 'Vehicule 1 après passage à la pompe<pre>';
print_r($vehicule1);
echo '</pre>';
echo 'Pompe après donnerEssence au vehicule1<pre>';
print_r($pompe1);
echo '</pre>';
$pompe1->donnerEssence($vehicule2);
echo 'Vehicule 2 après passage à la pompe<pre>';
print_r($vehicule2);
echo '</pre>';
echo 'Pompe après donnerEssence au vehicule2<pre>';
print_r($pompe1);
echo '</pre>';
$pompe1->donnerEssence($vehicule3);
echo 'Vehicule 3 après passage à la pompe<pre>';
print_r($vehicule3);
echo '</pre>';
echo 'Pompe après donnerEssence au vehicule3<pre>';
print_r($pompe1);
echo '</pre>';

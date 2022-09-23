<?php 

class Plombier 
{
    public function getSpecialite()
    {
        return "Plombier : tuyaux, robinets, etc";
    }

    public function getHoraires()
    {
        return "8h-19h";
    }
}

class Electricien 
{
    
    public function getSpecialite()
    {
        return "Electricien : cablages, disjoncteurs, etc";
    }

    public function getHoraires()
    {
        return "9h-20h";
    }
}
// -------------------------------

class Entreprise // la classe Entreprise n'hérite pas d'une autre classe, il n'y a pas de cohérence à dire qu'une entreprise est un plombier... ni un electricien... 
{
    public $nbrEmploye = 0;

    public function appelUnEmploye($employe)
    {
        $this->nbrEmploye++;
        // $employenum = 'employe' . $this->nbrEmploye;

        // $this->monEmploye1     $this->monEmploye2 etc
        $this->{"monEmploye" . $this->nbrEmploye} = new $employe;

        // Par défaut si je pointe sur une propriété n'existant pas, php va créer cette propriété à l'intérieur de l'objet
        // Dans notre exemple on concatène entre les accolades le nom de la propriété monEmploye + le nbrd'employé, me donnant donc monEmploye1 puis monEmploye2 etc, qui seront des propriétés créées à l'intérieur de l'objet
    }

}

$entreprise = new Entreprise;
echo '<pre>';
print_r($entreprise);
echo '</pre>';
$entreprise->appelUnEmploye('Plombier');
echo '<pre>';
print_r($entreprise);
echo '</pre>';
$entreprise->appelUnEmploye('Electricien');
echo '<pre>';
print_r($entreprise);
echo '</pre>';
// Entreprise Object
// (
//     [nbrEmploye] => 2
//     [monEmploye1] => Plombier Object
//         (
//         )
//     [monEmploye2] => Electricien Object
//         (
//         )
// )

                            //    Entreprise -> Plombier -> getSpecialite()
echo "Voici la spécialité : " . $entreprise->monEmploye1->getSpecialite();
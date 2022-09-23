<?php

namespace controller;


class Controller
{

    private $dbEntityRepository; // Le but ici étant de récupérer un objet issu de la classe modèle pour avoir accès aux résultats des requêtes, tout ce qui va venir du modele, il faut que le controller y ai accès, je ne vais pas faire ci dessous $this->db = new {connexion} NON je vais juste récupérer le résultat venant du modèle

    public function __construct()
    {
        // echo "Instanciation du controller<hr>"; // TEST

        // On affecte une instance de EntityRepository dans notre propriété qui sera accessible à tout moment depuis le controller
        $this->dbEntityRepository = new \model\EntityRepository;
    }

    // On va commencer à créer des conditions pour comprendre les actions de l'utilisateur et apporter un traitement pour chaque, en fonction d'une action dans GET, on déclenche une méthode

    public function handleRequest()
    {
        // On stocke la valeur de l'indice 'op' transmit dans l'URL
        if (isset($_GET['op'])) {
            $op = $_GET['op'];
        } else {
            $op = NULL;
        }
        try {

            // Ces conditions permettent de savoir ce que demande l'internaute, l'action qu'il va entrainer
            // Exemple : si l'internaute clique sur 'ajout employe', dans le controller cela executera la méthode save() qui permettra d'insérer dans la bdd
            // si ?op=update ou add
            if ($op == 'add' || $op == 'update') { // si on ajoute ou on modifie la methode save() sera exécutée 
                $this->save($op);
            } elseif ($op == 'select') { // si on selectionner les details d'un employé, la methode select() sera executée
                $this->select();
            } elseif ($op == 'delete') { // si on supprime un employé la methode delete sera executée
                $this->delete();
            } else { // Sinon on affichera tous les employés via la methode selectAll()
                $this->selectAll();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    // layout = le design de la page   template = le design du contenu de la page  parameters = les données de la bdd, le nom des champs ou de l'employé choisi
    // Attention compliqué
    public function render($layout, $template, $parameters = array())
    {
        // extract() : fonction prédéfinie qui permet d'extraire chaque indice d'un array, le transforme en variable et reçoit le contenu de cet indice
        extract($parameters); // $parameters['employes']  --->  $employes

        ob_start(); // on démarre une mise en tampon, pour faire une sorte de sauvegarde à partir de ce moment là, on garder en mémoire des données à partir d'ici
        // ob_start() démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.

        // $content = "view/$template"; // !! ERREUR !!! On ne conserve pas le template mais une chaine de caractère dans ce cas là, et on ne mets pas le require dans une variable

        require_once "view/$template"; // Cette inclusion est stockée directement dans la variable $content

        $content = ob_get_clean(); // permet ici de stocker dans $content, le VRAI affichage, le vrai rendu du require, ici on stocke le template (content) de notre page

        ob_start();
        require_once "view/$layout"; // envoi du gabari de base, du layout (header, nav, footer)

        return ob_end_flush(); // va libérer tout l'affichage et fait apparaitre sur le navigateur, avec le layout contenant le template, on va voir où mettre le $content


    }


    public function selectAll()
    {
        // echo 'méthode selectAll() | affichage de tous les employés !!'; // TEST
        // $r = $this->dbEntityRepository->selectAllEntityRepo();
        // echo '<pre>';
        // print_r($r);
        // echo '</pre>';

        //On va appeler la methode render
        $this->render('layout.php', 'affichage-employes.php', [
            'title' => 'Affichage des employes',
            'data' => $this->dbEntityRepository->selectAllEntityRepo(), // Retourne tous les employés
            'fields' => $this->dbEntityRepository->getFields(), // Retourne le nom des champs colonnes de la table SQL
            'id' => 'id' . ucfirst($this->dbEntityRepository->table) 
            // Si on suit une règle de nommage intéressante, à savoir les id de nos tables étant id suivi du nom de la table (avec une majuscule) on peut faire de cette façon, on concatène id suivi du nom de la table en y ajoutant le premier caractère en majuscule
        ]); 
    }

    // Méthode permettant d'afficher les details d'un employé
    public function select()
    {
        // echo "détail d'un employé";  // TEST

        // On stocke l'id de l'employé sélectionné dans l'url
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;

        $this->render('layout.php', 'details-employe.php', [
            'title' => "Détails de l'employé n°$id",
            'data' => $this->dbEntityRepository->selectEntityRepo($id), 
        ]);

    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = NULL;
        }
        $this->dbEntityRepository->deleteEntityRepo($id);
        $this->redirect('index.php');
        // header('Location: ' . 'index.php');
    }

    //---------------------- Redirection :   
    public function redirect($location)
    {
        header('Location: ' . $location);
    }

    public function save($op)
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = NULL;
        }

        if ($op == 'update') {
            $values = $this->dbEntityRepository->selectEntityRepo($id);
        } else {
            $values = '';
        }

        if (!empty($_POST)) {
            $this->dbEntityRepository->saveEntityRepo();
            $this->redirect('index.php');
        }

        $this->render('layout.php', 'formulaire-employes.php', array(
            'title' => 'Enregistrer les nouvelles infos',
            'op' => $op,
            'fields' => $this->dbEntityRepository->getFields(),
            'values' => $values
        ));


        // echo "la fonction save";  // TEST
       
    }
}

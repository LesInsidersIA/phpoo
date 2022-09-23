<?php

namespace model;

class EntityRepository // Terme utilisé via symfony, c'est le nom d'une classe représentant une table et permettant de faire des requetes
{
    private $db; // représente la co à la bdd, permet de stocker l'objet PDO, private afin de ne pas pouvoir la modifier en dehors de ma classe/objet
    public $table; // permet de stocker le nom de la table SQL afin de l'injecter dans les différentes requetes SQL //permet d'avoir accès à la table, de façon générique, afin de pouvoir changer les noms des tables

    public function getDb()
    {
        // Fonction permettant de construire la connexion à la bdd
        // Le but étant de construire la connec une seule fois, et de renvoyer la connexion s'il est déjà fait
        if (!$this->db) // Si db est vide/n'existe pas (la connexion n'est pas construite), on rentre dans la condition et on la construit
        {
            // Ici on va tenter de récupérer les infos XML pour construire la co à la bdd, avec l'objet pdo
            try {
                // simplexml_load_file : fonction prédéfinie php qui permet de charger un fichier xml et retourne un objet PHP SimpleXMLElement contenant toutes les informations de connexion à la bdd
                $xml = simplexml_load_file('app/config.xml');
                // echo '<pre>';print_r($xml);echo '</pre>'; // Comment faire pour tester ?....  le controller et l'autoload ne sont pas encore en place donc rdv sur la page entityrepository exercice, montrez moi comment avoir accès au print_r new Entityrepo et lancement function getDB ET il faudra mettre ../ devant app/config.xml, mais pas besoin plus tard, merci MVC

                $this->table = $xml->table; // On affecte le nom de la table sql récupérée via le fichier xml dans la propriété table de notre objet // On isole le nom de la table et pas forcement des autres, pour nos prochaines requete, on mettre select * from $table

                try {
                    // On tente d'exécuter la connexion à la BDD
                    // Nous n'écrivons pas en dur les coordonnées de la BDD, on injecte directement les données contenues dans le fichier xml
                    // On affecte à la propriété privée $db la connexion à la BDD PDO
                    $this->db = new \PDO("mysql:host=" . $xml->host . ";dbname=" . $xml->db, $xml->user, $xml->password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));

                    // echo '<pre>';print_r($this->db);echo '</pre>';
                } catch (\PDOException $e) {
                    echo "ERREUR : " . $e->getMessage();
                }
            } catch (\Exception $e) // Attention à \ pour sortir du namespace
            {
                echo "ERREUR : " . $e->getMessage();
            }
        }
        // si la propriété $db contient bien un objet pdo, on retourne cet objet là, on retourne la connexion
        return $this->db;
    }

    // Méthode permettant de sélectionner l'ensemble de la table 'employe'
    public function selectAllEntityRepo()
    {
        // $data = $db
        // On récupère l'objet pdo de connexion à la bdd
        // et sur un objet pdo on appele la methode query
        $data = $this->getDb()->query("SELECT * FROM " . $this->table);
        // On reçoit dans $data un objet PDOStatement
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $r;
    }

    // Méthode permettant de sélectionner tous les noms des colonnes de la table employe
    public function getFields()
    {
        //pour avoir accès à l'objet pdo et on lance une requete
        // DESC pour description table et récupération du nom des colonnes
        $data = $this->getDb()->query("DESC " . $this->table);
        $r = $data->fetchAll(\PDO::FETCH_ASSOC);
        // echo '<pre>';
        // print_r($r);
        // echo '</pre>';
        return $r;
    }

    // Méthode permettant de sélectionner un employé dans la BDD en fonction de son ID
    public function selectEntityRepo($id) 
    {
        // encore une fois pour que ma requète soit générique, je ne mets pas le nom de table en dur, ni le nom du champ id, j'utilise this table et id concaténé du nom de la table avec la première lettre en maj
        $data = $this->getDb()->query("SELECT * FROM " . $this->table . " WHERE id" . ucfirst($this->table) . " = " . (int) $id);
        // Attention, on utilise un prepare bind param execute pour plus de sécurité...
        $r = $data->fetch(\PDO::FETCH_ASSOC);
        return $r;
    }

    public function deleteEntityRepo($id)
    {
        $this->getDb()->query('DELETE FROM ' . $this->table . ' WHERE id' . ucfirst($this->table) . " = " . (int) $id);
    }

    public function saveEntityRepo()
    {

        // echo "OK je passe dans saveEntityRepo";
        $this->getDb()->query('REPLACE INTO ' . $this->table . ' (' . implode(', ', array_keys($_POST)) . ') VALUES (' . "'" . implode("', '", $_POST) . "')");
    }
}
// TEST
// $e = new EntityRepository;
// $e->getDb();

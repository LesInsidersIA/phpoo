<?php 
/*

    Pour éviter les injections XSS (du code css et/ou js mis dans les commentaires)
    Il est possible de modifier les carac notamment les < > qui représentent des balises
    A l'affichage ou à l'insertion en bdd on peut appeller des fonctions qui vont transformer les carac ayant des valeurs de traitements en entités html 
        par exemple : htmlspecialchars(), htmlentities(), strip_tags(), addslashes() 
        exemple d'un chevron ouvrant <  sera écrit en entité html comme ceci : $lt;

       pour injection SQL depuis le champ message ', ''); TRUNCATE commentaire; 
       pour injection css par exemple <style>body{display:none;}</style>
       pour injection js <script>while(true){alert('infecté!')}</script>



    EXERCICES:
    ------------
    - Création d'un espace de dialogue

    - 01 - Création de la BDD : dialogue
        - Table : commentaire
        - Champs de la table commentaire :
            - id_commentaire        INT(3) PK AI
            - pseudo                VARCHAR 255
            - message               TEXT
            - date_enregistrement   DATETIME

    - 02 - Créer une connexion à cette base avec PDO (création de l'objet PDO)
    - 03 - Création d'un formulaire permettant de poster un message (html, on oublie pas method post et les names dans les input)
        - Champs du formulaire :
                - pseudo (input type text)
                - message (textarea)
                - bouton de validation (type submit)
    - 04 - Récupération des saisies du form avec controle (je récupère avec $_POST, je fais des controles qui me semble judicieux, la taille du pseudo, regex sur le pseudo)
    - 05 - Déclenchement d'une requete d'enregistrement pour enregistrer les saisies dans la BDD
    sur l'objet pdo, je lance une requete insert into, je vérifie après dans phpmyadmin si c'est bien enregistré
    - 06 - Requête de récupération des messages afin de les afficher dans la page
    je lance sur pdo une requete select 
    - 07 - Affichage des commentaires avec un peu de mise en forme
    interprétation du résultat pdostatement qui vient de ma requete select 
    - 08 - Affichage en haut des messages du nombre de messages présents dans la BDD
    appel à rowCount sur l'objet pdostatement
    - 09 - Formatage de la date en français
    - 10 - Amélioration du design


*/

// 02 - Créer une connexion à cette base avec PDO
$host = 'mysql:host=localhost;dbname=dialogue'; 
$login = 'root'; // login
$password = ''; // mdp
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
);
$pdo = new PDO($host, $login, $password, $options);

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
$req = '';
// - 04 - Récupération des saisies du form avec controle 
if( isset($_POST['pseudo']) && isset($_POST['message']) ) {
    $pseudo = trim($_POST['pseudo']);
    $message = trim($_POST['message']);

    // - 05 - Déclenchement d'une requete d'enregistrement pour enregistrer les saisies dans la BDD
    $req = "INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ('$pseudo', '$message', NOW())";
    // $enregistrement = $pdo->query($req);

    // Pour éviter les injections SQL il faut privilégier prepare() car $pseudo et $message viennent du formulaire et pourrait contenir du code malveillant.
    // Avec prepare les injections ne sont pas possibles.
    $enregistrement = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (:pseudo, :message, NOW())");
    $enregistrement->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $enregistrement->bindParam(':message', $message, PDO::PARAM_STR);
    $enregistrement->execute();


    // Pour éviter de renvoyer le même enregistrement en rechargeant la page, on va rediriger avec PHP sur cette page après l'enregistrement pour perdre les données dans $_POST
    header('location:dialogue.php');
}

// - 06 - Requete de récupération des messages afin de les afficher dans cette page
$liste_commentaire = $pdo->query("SELECT pseudo, message, date_format(date_enregistrement, '%d/%m/%Y à %H:%i:%s') AS date_fr FROM commentaire ORDER BY date_enregistrement DESC");
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <!-- Google font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <!-- Playfair display -->
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
        <!-- Roboto -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            * {
                font-family: 'Roboto', sans-serif;
            }
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Playfair Display', serif;
            }
        </style>

        <title>Dialogue</title>
    </head>
    <body class="bg-secondary" >
        <div class="container bg-light g-0">
            <div class='row '>
                <div class="col-12">
                    <h2 class="text-center text-dark fs-1 bg-light p-5 border-bottom"><i class="far fa-comments"></i> Espace de dialogue <i class="far fa-comments"></i></h2>
                    <form method="post" class="mt-5 mx-auto w-50 border p-3 bg-white">
                        
                        <?php echo $req; // on affiche la requete pour voir les injections SQL ?>
                    
                        <hr>
                        <div class="mb-3">
                            <label for="pseudo" class="form-label">Pseudo <i class="fas fa-user-alt"></i></label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message <i class="fas fa-feather-alt"></i></label>
                            <textarea class="form-control" id="message" name="message"></textarea>
                        </div>
                        <div class="mb-3">
                            <hr>
                            <button type="submit" class="btn btn-secondary w-100" id="enregistrer" name="enregistrer"><i class="fas fa-keyboard"></i> Enregistrer <i class="fas fa-keyboard"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class='row mt-5'> 
                <div class="col-12">               
                    <!-- Affichage des commentaire -->
                    <p class="w-75 mx-auto mb-3"><?php
                        // - 08 - Affichage en haut des messages du nombre de messages présents dans la bdd
                        echo 'il y a : <b>' . $liste_commentaire->rowCount() . '</b> messages';
                    ?></p>
                    <?php 
                        // - 07 - Affichage des commentaire avec un peu mise en forme
                        while($commentaire = $liste_commentaire->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="card w-75 mx-auto mb-3">
                                    <div class="card-header bg-dark text-white">
                                        Par : ' . htmlspecialchars($commentaire['pseudo']) . ', le : ' . $commentaire['date_fr'] . '
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">' . htmlspecialchars($commentaire['message']) . '</p>
                                    </div>
                                </div>'; 
                        }
                    
                    
                    ?>
                    
                </div>
            </div>
        </div>


        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>
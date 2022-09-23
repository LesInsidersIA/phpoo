<?php

echo '<pre>';
// print_r($data); // la variable $data provient du controller, de la methode selectAll() et plus précisément définie dans la méthode render() comme paramètres. Elle contient tous les employes récupérés en bdd
// print_r($fields);
echo '</pre>';

?>

<table class="table table-bordered text-center">


    <thead>
        <tr>
            <?php foreach ($fields as $value) { ?>
                <th><?= $value['Field'] ?> </th>
            <?php } ?>
            <th>Voir</th>
            <th>Modif</th>
            <th>Suppr</th>
        </tr>
    </thead>
    <?php foreach ($data as $dataEmploye) { ?>

        <tr>
            <!-- implode : fonction prédéfinie qui rassemble les éléments d'un array en une chaine de caractère avec un séparateur choisi, ici notre séparateur, nous incluons du code html td pour notre table-->
            <td><?= implode('</td><td>', $dataEmploye) ?></td>

            <td><a href="?op=select&id=<?=$dataEmploye[$id]?>" class="btn btn-dark"><i class="fas fa-eye"></i></a></td>

            <td><a href="?op=update&id=<?=$dataEmploye[$id]?>" class="btn btn-dark"><i class="fas fa-edit"></i></a></td>

            <td><a href="?op=delete&id=<?=$dataEmploye[$id]?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
        </tr>

    <?php } ?>

</table>
<hr>
<hr>
<hr>
<hr>
<hr>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <?php foreach ($fields as $value) { ?>
                <th><?= $value['Field'] ?> </th>
            <?php } ?>
        </tr>
    </thead>
    <?php
    //----- Sinon avec foreach
    foreach ($data as $sous_tableau) {
        echo '<tr>';
        foreach ($sous_tableau as $valeur) {
            echo '<td>' . $valeur . '</td>';
        }
        echo '<tr>';
    }
    ?>
</table>
<hr>
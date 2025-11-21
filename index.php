<?php
require "./src/dao/DbConnection.php";
// 1. Connexion à la base
$dbConnexion = DbConnection::getInstance();
$pdo = $dbConnexion->getConnection();

$reponse = $pdo->query("SELECT * FROM restaurant");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>restaurant</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
<h1>Liste des Restaurants</h1>
<main>
    <table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Adresse</th>
        <th>Prix</th>
        <th>Commentaire</th>
        <th>Note</th>
        <th>Visite</th>
    </tr>
    <?php while ($donnees = $reponse->fetch()): ?>
        <tr>
            <td><?= $donnees['id'] ?></td>
            <td><?= $donnees['nom'] ?></td>
            <td><?= $donnees['adresse'] ?></td>
            <td><?= $donnees['prix'] ?> €</td>
            <td><?= $donnees['commentaire'] ?></td>
            <td><?= $donnees['note'] ?>/5</td>
            <td><?= $donnees['visite'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
</main>


</body>
</html>
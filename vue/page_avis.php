<?php
    $title = "Ajouter un restaurant";
    require __DIR__ . '/../header.php';
    require_once __DIR__ . '/../src/dao/RestaurantRepository.php';
    $repo = new RestoRepository(); //Créer une instance du repository
    $tableHtml = $repo->renderHtml(); // Générer le tableau HTML

?>

<main>
    <h1>Liste des avis</h1>

    <?php
    // Génère et affiche le tableau
    echo $repo->renderHtml();
    ?>
     
</main>
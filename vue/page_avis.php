<?php
    $title = "Tous les avis des restaurants";
    require __DIR__ . '/../header.php';
    require_once __DIR__ . '/../src/dao/RestaurantRepository.php';
    $repo = new RestoRepository(); //Créer une instance du repository
    $tableHtml = $repo->renderHtml(); // Générer le tableau HTML

?>

<main>
    <h1>Liste des avis</h1>

    <?php if (isset($_GET['success'])): ?> // Affichage du message de succès ?>
        <div class="success"> 
            ✅ <?= htmlspecialchars($_GET['success']) ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?> // Affichage du message d'erreur ?>
        <div class="error">
            ❌ <?= htmlspecialchars($_GET['error']) ?> 
        </div>
    <?php endif; ?>

    <?php
    // Génère et affiche le tableau
    echo $repo->renderHtml();
    ?>
     
</main>
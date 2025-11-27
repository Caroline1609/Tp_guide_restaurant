<?php
    $title = "Tous les avis des restaurants";
    require __DIR__ . '/../header.php';
    require_once __DIR__ . '/../src/dao/RestaurantRepository.php';
    $repo = new RestoRepository(); //Créer une instance du repository
    $tableHtml = $repo->renderHtml(); // Générer le tableau HTML

?>

<main>
    <h1>Liste des avis</h1>

    <form method="POST" action="../src/dao/update_json.php"> 
    <button type="submit" name="update_json" class="btn btn-primary">
        Actualiser le JSON
    </button>
</form>

<?php if (isset($_GET['success']) && $_GET['success'] === 'json_updated') { //
    echo '<p style="color: green;">✅ Le fichier JSON a été mis à jour avec succès.</p>';
}
?>

<?php if (isset($_GET['success'])): ?>
    <div class="success"> 
        ✅ <?= htmlspecialchars($_GET['success']) ?>
    </div>
<?php endif; ?>
    
<?php if (isset($_GET['error'])): ?>
    <div class="error">
        ❌ <?= htmlspecialchars($_GET['error']) ?> 
    </div>
<?php endif; ?>

    <?php
    // Génère et affiche le tableau
    echo $tableHtml;
    ?>

</main>
<?php require __DIR__ . '/../footer.php'; ?>
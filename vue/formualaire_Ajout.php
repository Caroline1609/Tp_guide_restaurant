<?php require __DIR__ . '/header.php'; ?>

<body>

<section id="form-ajout">
    <h2>Ajouter un restaurant</h2>

    <?php if (!empty($successMsg)): ?> 
        <p class="success"><?php echo $successMsg; ?></p>
    <?php endif; ?>

    <?php if (!empty($errorMsg)): ?>
        <p class="error">Erreur: <?php echo $errorMsg; ?></p>
    <?php endif; ?>

    <form action="../src/dao/insert_restaurant.php" method="post">

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required maxlength="50">

        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" required maxlength="100">

        <label for="prix">Prix (ex : 25.00) :</label>
        <input type="number" id="prix" name="prix" step="0.01" required>

        <label for="commentaire">Commentaire :</label>
        <textarea id="commentaire" name="commentaire" rows="5" cols="50" required></textarea>

        <label for="note">Note (0-10) :</label>
        <input type="number" id="note" name="note" step="0.1" min="0" max="10" required>

        <label for="visite">Date de visite :</label>
        <input type="date" id="visite" name="visite" required>

        <button type="submit">Ajouter</button>
    </form>
</section>

</body>
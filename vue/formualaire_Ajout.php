<?php require __DIR__ . '/header.php'; ?>
<?php require_once __DIR__ . '../'; ?>

<section id="form-ajout">  <!-- Formulaire d'ajout -->
        <h2>Ajouter un restaurant</h2>
        
        <?php
            if ($successMsg !== ''): ?> 
            <p class="success"><?php echo $successMsg; ?></p>
        <?php endif; ?>

        <?php if ($errorMsg !== ''): ?>
            <p class="error">Erreur: <?php echo $errorMsg; ?></p>
        <?php endif; ?>
        
        <form action="./src/dao/insert_restaurant.php" method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required maxlength="50" value="<?php echo $old['nom']; ?>">

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" required maxlength="100" value="<?php echo $old['adresse']; ?>">

            <label for="prix">Prix (ex : 25.00) :</label>
            <input type="number" id="prix" name="prix" step="0.01" required value="<?php echo $old['prix']; ?>">

            <label for="commentaire">Commentaire :</label>
            <textarea id="commentaire" name="commentaire" rows="5" cols="50" required><?php echo $old['commentaire']; ?></textarea>

            <label for="note">Note (0-10) :</label>
            <input type="number" id="note" name="note" step="0.1" min="0" max="10" required value="<?php echo $old['note']; ?>">

            <label for="visite">Date de visite :</label> 
            <input type="date" id="visite" name="visite" required value="<?php echo $old['visite']; ?>">

            <button type="submit">Ajouter</button>
    </form>
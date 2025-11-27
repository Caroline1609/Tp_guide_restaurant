<?php
    $title = "Modifier un avis de restaurant";
    require __DIR__ . '/../header.php';
    require_once __DIR__ . '/../src/dao/RestaurantRepository.php';



    $restoRepo = new RestoRepository();


    $id = $_GET['id'] ?? 0; // Récupère l'ID depuis l'URL, ou 0 par défaut

    $restaurant = $restoRepo->searchById($id);
    
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'nom' => $_POST['nom'], 
            'adresse' => $_POST['adresse'],
            'prix' => $_POST['prix'],
            'commentaire' => $_POST['commentaire'],
            'note' => $_POST['note'],
            'visite' => $_POST['visite'],
        ];

        $success = $restoRepo->modifyRow($id, $data);
        if ($success) {
            echo "<p>Restaurant modifié avec succès !</p>";
            echo "<p><a href='page_avis.php'>Retour à la liste</a></p>";
        } else {
            echo "<p>Erreur lors de la modification.</p>";
        }
    }
?>

<body>
    <section id="form-ajout">
        <h1>Modifier le restaurant</h1>
        <form method="POST">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $restaurant["nom"] ??"indeterminé" ?>" required maxlength="50">

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $restaurant["adresse"] ??"indeterminé" ?>" required maxlength="100">

            <label for="prix">Prix (ex : 25.00) :</label>
            <input type="number" id="prix" name="prix" value="<?php echo $restaurant["prix"] ??"indeterminé" ?>" step="0.01" required>

            <label for="commentaire">Commentaire :</label>
            <textarea id="commentaire" name="commentaire" rows="5" cols="50" required><?php echo $restaurant["commentaire"] ?? "indeterminé"; ?></textarea>

            <label for="note">Note (0-10) :</label>
            <input type="number" id="note" name="note" value="<?php echo $restaurant["note"] ??"indeterminé" ?>" step="0.1" min="0" max="10" required>

            <label for="visite">Date de visite :</label>
            <input type="date" id="visite" name="visite" value="<?php echo $restaurant["visite"] ??"indeterminé" ?>" required>

            <button type="submit">Modifier la critique</button>
        </form>
    </section>
</body>
</html>

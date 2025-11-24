<?php

require "./src/dao/RestaurantRepository.php"; // Inclure le fichier du repository
$repo = new RestoRepository(); //Créer une instance du repository
$tableHtml = $repo->renderHtml(); // Générer le tableau HTML

require __DIR__ . '/vue/header.php';
?>





<main>
    <h1>Liste des Restaurants</h1>
    <?php 
        // Messages et valeurs pré-remplies pour le formulaire
        $successMsg = (!empty($_GET['success']) && $_GET['success'] == 1) ? 'Restaurant ajouté avec succès.' : ''; // Messages de succès
        $errorMsg = !empty($_GET['error']) ? htmlspecialchars(urldecode($_GET['error'])) : ''; // Messages d'erreur
        
        $old = [ 
            'nom' => isset($_GET['nom']) ? htmlspecialchars(urldecode($_GET['nom'])) : '',
            'adresse' => isset($_GET['adresse']) ? htmlspecialchars(urldecode($_GET['adresse'])) : '',
            'prix' => isset($_GET['prix']) ? htmlspecialchars(urldecode($_GET['prix'])) : '',
            'commentaire' => isset($_GET['commentaire']) ? htmlspecialchars(urldecode($_GET['commentaire'])) : '',
            'note' => isset($_GET['note']) ? htmlspecialchars(urldecode($_GET['note'])) : '',
            'visite' => isset($_GET['visite']) ? htmlspecialchars(urldecode($_GET['visite'])) : '',
        ];
    ?>        
</main>

</body>
</html>

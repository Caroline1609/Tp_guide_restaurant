<?php

require_once __DIR__ . '/RestaurantRepository.php'; // Inclure le fichier du repository

if (!isset($_POST['id'])) {
    header("Location: ../../vue/page_avis.php?error=ID manquant"); // Redirige si l'ID n'est pas fourni
    exit;
}

$id = (int)$_POST['id'];

$repo = new RestoRepository(); //   Créer une instance du repository

$delete = $repo->deleteById($id); // Appelle la méthode de suppression

if ($delete) { // Si la suppression a réussi

    header("Location: ../../vue/page_avis.php?success=Restaurant supprimé"); // Redirige avec un message de succès
} else {
    header("Location: ../../vue/page_avis.php?error=Erreur de suppression"); // Redirige avec un message d'erreur
}
exit;
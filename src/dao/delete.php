<?php
// On charge le fichier qui contient la classe RestoRepository
require_once __DIR__ . '/RestaurantRepository.php';

if (!isset($_POST['id'])) {
    header("Location: ../../vue/page_avis.php?error=ID manquant");
    exit;
}

$id = (int)$_POST['id'];

$repo = new RestoRepository();

// On essaie de supprimer le restaurant
$delete = $repo->deleteById($id);

if ($delete) {

    header("Location: ../../vue/page_avis.php?success=Restaurant supprimé");
} else {
    header("Location: ../../vue/page_avis.php?error=Erreur de suppression");
}
exit;
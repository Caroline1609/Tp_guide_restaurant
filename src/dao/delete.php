<?php

require_once __DIR__ . '/RestaurantRepository.php';

if (!isset($_POST['id'])) {
    header("Location: ../../vue/page_avis.php?error=ID manquant");
    exit;
}

$id = (int)$_POST['id'];

$repo = new RestoRepository();

$delete = $repo->deleteById($id);

if ($delete) {

    header("Location: ../../vue/page_avis.php?success=Restaurant supprimé");
} else {
    header("Location: ../../vue/page_avis.php?error=Erreur de suppression");
}
exit;
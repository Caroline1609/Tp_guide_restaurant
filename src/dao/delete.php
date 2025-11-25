<?php
require_once __DIR__ . '/RestaurantRepository.php';

if (!isset($_GET['id'])) {
    die("ID manquant.");
}

$repo = new RestoRepository();
$id = (int)$_GET['id'];

if ($repo->deleteById((int)$_GET['id'])) {
    header("Location: ../../vue/page_avis.php?delete=success"); // Redirection après suppression
    exit;
} else {
    echo "Erreur lors de la suppression.";
}

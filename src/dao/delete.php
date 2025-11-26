<?php
// On charge le fichier qui contient la classe RestoRepository
require_once __DIR__ . '/RestaurantRepository.php';

// Est-ce que l'ID existe dans le formulaire ?
if (!isset($_POST['id'])) {
    // Si non, on redirige avec un message d'erreur
    header("Location: ../../vue/page_avis.php?error=ID manquant");
    exit;
}

// On transforme l'ID en nombre entier pour la sécurité
$id = (int)$_POST['id'];

// On crée une instance du repository (la classe qui parle à la base de données)
$repo = new RestoRepository();

// On essaie de supprimer le restaurant
$resultat = $repo->deleteById($id);

// Est-ce que la suppression a réussi ?
if ($resultat) {
    // OUI : on redirige avec un message de succès
    header("Location: ../../vue/page_avis.php?success=Restaurant supprimé");
} else {
    // NON : on redirige avec un message d'erreur
    header("Location: ../../vue/page_avis.php?error=Erreur de suppression");
}
exit;
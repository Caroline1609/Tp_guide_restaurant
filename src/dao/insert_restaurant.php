<?php
require_once __DIR__ . '/RestaurantRepository.php';

// Récupération et nettoyage des données
$nom = trim($_POST['nom'] ?? ''); // Utilisation de trim pour enlever les espaces inutiles
$adresse = trim($_POST['adresse'] ?? '');    
$prix = $_POST['prix'] ?? null;
$commentaire = trim($_POST['commentaire'] ?? '');
$note = $_POST['note'] ?? null;
$visite = $_POST['visite'] ?? null;

// Validation minimale
$errors = [];
if ($nom === '') $errors[] = 'Nom requis.'; // Vérifie que le nom n'est pas vide
if ($adresse === '') $errors[] = 'Adresse requise.'; // Vérifie que l'adresse n'est pas vide
if ($prix === null || $prix === '') $errors[] = 'Prix requis.'; // Vérifie que le prix n'est pas vide
if (!is_numeric($prix)) $errors[] = 'Prix invalide.'; // Vérifie que le prix est un nombre
if ($commentaire === '') $errors[] = 'Commentaire requis.'; // Vérifie que le commentaire n'est pas vide
if ($note === null || $note === '') $errors[] = 'Note requise.'; // Vérifie que la note n'est pas vide
if (!is_numeric($note)) $errors[] = 'Note invalide.'; // Vérifie que la note est un nombre
if ($visite === null || $visite === '') $errors[] = 'Date de visite requise.'; // Vérifie que la date de visite n'est pas vide

if (!empty($errors)) {
    // Retour à index.php avec message d'erreur et valeurs précédentes
    $msg = urlencode(implode(' ', $errors)); // Concatène les messages d'erreur
    $params = [ //  Prépare les paramètres pour la redirection
        'error' => $msg, // Message d'erreur
        'nom' => urlencode($nom), //    Valeur précédente du nom
        'adresse' => urlencode($adresse), // Valeur précédente de l'adresse
        'prix' => urlencode($prix), // Valeur précédente du prix
        'commentaire' => urlencode($commentaire), // Valeur précédente du commentaire
        'note' => urlencode($note), // Valeur précédente de la note
        'visite' => urlencode($visite), // Valeur précédente de la date de visite
    ]; 
    header('Location: ../../index.php?' . http_build_query($params));// Redirection vers index.php avec les paramètres
    exit;
}

$repo = new RestoRepository();

$data = [
    'nom' => $nom, // Nom du restaurant
    'adresse' => $adresse, // Adresse du restaurant
    'prix' => $prix, // Prix moyen
    'commentaire' => $commentaire, // Commentaire sur le restaurant
    'note' => $note,    // Note attribuée
    'visite' => $visite,    // Date de la visite
];

$ok = $repo->insertRow($data); // Insertion des données dans la base

if ($ok) {   
    // Redirection vers page_avis.php qui est dans /vue/
    header('Location: ../../vue/page_avis.php?success=' . urlencode('Restaurant ajouté avec succès')); // Message de succès
} else {
    // En cas d'échec, retour vers index.php (à la racine)
    header('Location: ../../index.php?error=' . urlencode('Erreur lors de l\'ajout du restaurant')); // Message d'erreur
}
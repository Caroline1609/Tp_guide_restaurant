<?php
require_once __DIR__ . '/RestaurantRepository.php';

// Récupération et nettoyage des données
$nom = trim($_POST['nom'] ?? '');
$adresse = trim($_POST['adresse'] ?? '');
$prix = $_POST['prix'] ?? null;
$commentaire = trim($_POST['commentaire'] ?? '');
$note = $_POST['note'] ?? null;
$visite = $_POST['visite'] ?? null;

// Validation minimale
$errors = [];
if ($nom === '') $errors[] = 'Nom requis.';
if ($adresse === '') $errors[] = 'Adresse requise.';
if ($prix === null || $prix === '') $errors[] = 'Prix requis.';
if (!is_numeric($prix)) $errors[] = 'Prix invalide.';
if ($commentaire === '') $errors[] = 'Commentaire requis.';
if ($note === null || $note === '') $errors[] = 'Note requise.';
if (!is_numeric($note)) $errors[] = 'Note invalide.';
if ($visite === null || $visite === '') $errors[] = 'Date de visite requise.';

if (!empty($errors)) {
    // Retour à index.php avec message d'erreur et valeurs précédentes
    $msg = urlencode(implode(' ', $errors));
    $params = [
        'error' => $msg,
        'nom' => urlencode($nom),
        'adresse' => urlencode($adresse),
        'prix' => urlencode($prix),
        'commentaire' => urlencode($commentaire),
        'note' => urlencode($note),
        'visite' => urlencode($visite),
    ];
    header('Location: ../../index.php?' . http_build_query($params));
    exit;
}

$repo = new RestoRepository();

$data = [
    'nom' => $nom,
    'adresse' => $adresse,
    'prix' => $prix,
    'commentaire' => $commentaire,
    'note' => $note,
    'visite' => $visite,
];

$ok = $repo->insertRow($data);

if ($ok) {
    header('Location: ../../index.php?success=1');
    exit;
} else {
    $params = ['error' => urlencode("Impossible d'insérer en base.")];
    header('Location: ../../index.php?' . http_build_query($params)); 
    exit;
}

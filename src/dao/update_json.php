<?php 

require_once __DIR__ . '/RestaurantRepository.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_json'])) { // Vérifie si le formulaire a été soumis
    
    try {

        $repository = new RestoRepository();

        $repository->chercherCollection();
        

        header('Location: ../../vue/page_avis.php?success=json_updated');
        exit;
        
    } catch (Exception $e) {

        error_log("Erreur de mise à jour JSON: " . $e->getMessage());
        

        header('Location: ../../vue/page_avis.php?error=update_failed&msg=' . urlencode($e->getMessage()));
        exit;
    }
} else {

    header('Location: ../../vue/page_avis.php');
    exit;
}

?>
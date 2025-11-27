<?php
require "./src/dao/RestaurantRepository.php"; // Inclure le fichier du repository
$repo = new RestoRepository(); //Créer une instance du repository
$tableHtml = $repo->renderHtml(); // Générer le tableau HTML
require 'header.php';


/*var_export($repo->infoTable());*/

?>

<body>

<?php  

    $json = $repo->chercherCollection();

    echo "<pre>";
    echo "Résultat de chercherCollection() :\n";
    echo $json;
    echo "</pre>";

    $decoded = json_decode($json, true);
    if (json_last_error() === JSON_ERROR_NONE) { //
        echo "<p>Le JSON est valide.</p>"; 
        echo "<p>Nombre de restaurants : " . count($decoded) . "</p>";
    } else {
        echo "<p>Erreur de décodage JSON : " . json_last_error_msg() . "</p>";
    }


?>

</body>
</html>

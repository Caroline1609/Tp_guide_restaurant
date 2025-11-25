<?php
require "./src/dao/RestaurantRepository.php"; // Inclure le fichier du repository
$repo = new RestoRepository(); //Créer une instance du repository
$tableHtml = $repo->renderHtml(); // Générer le tableau HTML
require 'header.php';


/*var_export($repo->infoTable());*/

?>

<body>





</body>
</html>

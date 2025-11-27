<?php
require "./src/dao/RestaurantRepository.php"; // Inclure le fichier du repository
$repo = new RestoRepository(); //Créer une instance du repository
$tableHtml = $repo->renderHtml(); // Générer le tableau HTML
require 'header.php';


/*var_export($repo->infoTable());*/

?>

<body>
<main>
    <h1>Découvrez meilleures tables d'Alsace</h1>
        <p>Avis authentiques, restaurants testés, notes précises.</p>
        <nav>
        <section class="section">
            <div class="card">
                <div class="card-icon">★</div>
                <h3>Voir les avis</h3>
                <a href="#">Voir tous les avis</a>
            </div>
            <div class="card">
                <div class="card-icon">↑</div>
                <h3>Restaurants les mieux notés</h3>
                <a href="#">Classement co</a>
            </div>
            <div class="card">
                <div class="card-icon">✏️</div>
                <h3>Ajouter une critique</h3>
                <a href="#">Nouvelle critique</a>
            </div>
        </section>

        <section>
            <h2>À propos</h2>
            <p>
                Critiqué Culinaire est un projet qui met en valeur les restaurants d'Alsace grâce à des critiques indépendantes, honnêtes et détaillées.
                Découvrez nos tests, nos coups de cœur, et partagez vos propres expériences.
            </p>
        </section>

        <div class="gallery">
            <img src="assets/img/choucroute.jpg" alt="Plat 1">
            <img src="https://via.placeholder.com/200x150" alt="Plat 2">
            <img src="https://via.placeholder.com/200x150" alt="Plat 3">
            <img src="https://via.placeholder.com/200x150" alt="Plat 4">
        </div>
    </main>



</body>
</html>

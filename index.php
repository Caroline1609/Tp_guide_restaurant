<?php
require "./src/dao/RestaurantRepository.php"; // Inclure le fichier du repository
$repo = new RestoRepository(); //Créer une instance du repository
$tableHtml = $repo->renderHtml(); // Générer le tableau HTML
require 'header.php';


/*var_export($repo->infoTable());*/

?>

<body>
<main>
    <div class="title">
        <h1>Découvrez meilleures tables d'Alsace</h1>
        <h2>Avis authentiques, restaurants testés, notes précises.</h2>
    </div>

        <nav>
        <section class="section">
            <div class="card">
                <div class="card-icon">★</div>
                <h3>Voir les avis</h3>
                <a href="/tp_guide_restaurant/vue/page_avis.php">Voir tous les avis</a>
            </div>
            <div class="card">
                <div class="card-icon">✏️</div>
                <h3>Ajouter une critique</h3>
                <a href="/tp_guide_restaurant/vue/formualaire_Ajout.php">Nouvelle critique</a>
            </div>
        </section>
        <section class="a_propos">
            <h2>À propos</h2>
            <p>
                Critiqué Culinaire est un projet qui met en valeur les restaurants d'Alsace grâce à des critiques indépendantes, honnêtes et détaillées.
                Découvrez nos tests, nos coups de cœur, et partagez vos propres expériences.
            </p>
            <div class="gallery">
                <img src="assets/img/choucroute.jpg" alt="choucroute">
                <img src="assets/img/baecleoffe.jpg" alt="baecleoffe">
                <img src="assets/img/tarte_flambe.jpg" alt="tarte_flambe">
                <img src="assets/img/viande-rouler.jpg" alt="viande-rouler">
            </div>
        </section>
    </main>



</body>
</html>

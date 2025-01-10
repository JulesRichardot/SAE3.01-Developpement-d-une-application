<?php
// Inclure la connexion à la base de données ou le modèle si nécessaire
require_once "./App/models/Model.php";

// Récupérer les jeux populaires depuis la base de données
$model = Model::getInstance();
$jeuxPopulaires = $model->getJeuParCategorie('populaire'); // Récupère les jeux de la catégorie "populaire"
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection de jeux</title>
    <link href="style.css" rel="stylesheet"/>
</head>
<body>
    <header class="nav-header">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e24d432f71ae5fc037e972e78951ca15052e5e8c7824a911375a22f8623cb7b3?placeholderIfAbsent=true&apiKey=d20a853adbac4dde9b424a402120db37" alt="Games Collection Logo" class="logo" />
        <nav class="nav-links">
            <div>Accueil</div>
            <div>Catégories</div>
            <div>Découvrir</div>
            <div>Mon Compte</div>
        </nav>
    </header>

    <div>
        <input type="search" placeholder="Rechercher un jeu par titre ou catégories">
    </div>

    <div id="presentation">
        <h1>Collection de jeux de sociétés</h1>
        <h4>Découvrez et gérez votre collection de jeux de sociétés</h4>
        <input type='button' class="Bouton" value="Découvrir"/>
        <input type='button' class="Bouton" value="Catégories"/>
    </div>

    <div id="jeux_pop">
        <h2>Découvrez nos jeux les plus populaires</h2>
        <?php
        // Afficher les jeux populaires récupérés depuis la base de données
        if ($jeuxPopulaires && count($jeuxPopulaires) > 0) {
            foreach ($jeuxPopulaires as $jeu) {
                echo "<div>" . htmlspecialchars($jeu['titre']) . "</div>"; // Affiche le titre du jeu
            }
        } else {
            echo "<div>Aucun jeu populaire trouvé.</div>";
        }
        ?>
    </div>

    <div class="infos_comp">
        <div>A propos.</div>
        <div>Contact.</div>
        <div>Mention légales</div>
    </div>

</body>
</html>

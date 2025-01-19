<?php
require_once "./App/models/Model.php";

// Récupérer les jeux populaires depuis la base de données
$model = Model::getInstance();
$jeuxPopulaires = $model->getJeuParCategorie('populaire'); // Récupère les jeux de la catégorie "populaire"

$jeu1 = $model->getJeuAleatoire();
$jeu2 = $model->getJeuAleatoire();
$jeu3 = $model->getJeuAleatoire();

if (!$jeu1) {
    $jeu1 = ['id_jeu' => 0, 'titre' => 'Aucun jeu', 'mots_cles' => 'Non disponible'];
}
if (!$jeu2) {
    $jeu2 = ['id_jeu' => 0, 'titre' => 'Aucun jeu', 'mots_cles' => 'Non disponible'];
}
if (!$jeu3) {
    $jeu3 = ['id_jeu' => 0, 'titre' => 'Aucun jeu', 'mots_cles' => 'Non disponible'];
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection de jeux</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <!-- Tête de page -->
    <header class="nav-header">
        <a href="index.php">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e24d432f71ae5fc037e972e78951ca15052e5e8c7824a911375a22f8623cb7b3?placeholderIfAbsent=true&apiKey=d20a853adbac4dde9b424a402120db37" alt="Logo" class="logo">
        </a>        
        <nav class="nav-links">
            <a href="index.php" class="nav-link">Accueil</a>
            <a href="decouvrir.php" class="nav-link">Découvrir</a>
            <a href="monCompte.php" class="nav-link">Mon Compte</a>
            <a href="connexion_inscription.php" class="nav-link">Connexion/Inscription</a>
        </nav>
    </header>

    <!-- Barre de recherche -->
    <div class="search-bar">
        <input type="search" placeholder="Rechercher un jeu par titre ou catégories">
    </div>

    <!-- Présentation -->
    <section id="presentation">
        <h1>Collection de jeux de société</h1>
        <h4>Découvrez et gérez votre collection de jeux de société</h4>
        <div class="actions">
            <a href="decouvrir.php"><button class="Bouton">Découvrir</button></a>
        </div>
    </section>

    <!-- Section des jeux populaires -->
    <section id="jeux_pop">
        <h2>Découvrez des jeux !</h2>
        <div class="cards">
            <!-- Première carte -->
            <a href="boite_jeu.php?id=<?= $jeu1['id_jeu'] ?>">
                <div class="card">
                    <h3><?= htmlspecialchars($jeu1['titre']) ?></h3>
                    <p><?= htmlspecialchars($jeu1['mots_cles']) ?></p>
                    <p>Nombre d'exemplaires disponibles</p>
                </div>
            </a>

            <!-- Deuxième carte -->
            <a href="boite_jeu.php?id=<?= $jeu2['id_jeu'] ?>">
                <div class="card">
                    <h3><?= htmlspecialchars($jeu2['titre']) ?></h3>
                    <p><?= htmlspecialchars($jeu2['mots_cles']) ?></p>
                    <p>Nombre d'exemplaires disponibles</p>
                </div>
            </a>

            <!-- Troisième carte -->
            <a href="boite_jeu.php?id=<?= $jeu3['id_jeu'] ?>">
                <div class="card">
                    <h3><?= htmlspecialchars($jeu3['titre']) ?></h3>
                    <p><?= htmlspecialchars($jeu3['mots_cles']) ?></p>
                    <p>Nombre d'exemplaires disponibles</p>
                </div>
            </a>
        </div>
    </section>

    <!-- Pied de page -->
    <footer>
        <div class="colonne">
            <h4>À propos</h4>
            <ul>
                <li><a href="">Mention légales</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>

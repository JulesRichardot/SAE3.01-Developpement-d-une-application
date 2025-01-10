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
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e24d432f71ae5fc037e972e78951ca15052e5e8c7824a911375a22f8623cb7b3?placeholderIfAbsent=true&apiKey=d20a853adbac4dde9b424a402120db37" alt="Games Collection Logo" class="logo">
        <nav class="nav-links">
            <a href="index.php">Accueil</a>
            <a href="decouvrir.php">Découvrir</a>
            <a href="compte.php">Mon Compte</a>
            <a href="connexion_inscription.php">Connexion/Inscription</a>
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
        <h2>Découvrez nos jeux les plus populaires</h2>
        <div class="cards">
            <?php foreach ($popularGames as $game): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($game['title']) ?></h3>
                    <p><?= htmlspecialchars($game['category']) ?></p>
                    <p><?= htmlspecialchars($game['available_copies']) ?> exemplaires disponibles</p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Pied de page -->
    <footer>
        <div class="colonne">
            <h4>À propos</h4>
            <ul>
                <li><a href="#">Mentions légales</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenue sur la page d'accueil</h1>

    <h2>Liste des jeux populaires</h2>
    <ul>
        <?php if (!empty($liste)): ?>
            <?php foreach ($liste as $game): ?>
                <li>
                    <strong><?= htmlspecialchars($game['titre']) ?></strong> <!-- Assurez-vous que 'titre' est une colonne dans votre DB -->
                    <p><?= htmlspecialchars($game['description']) ?></p> <!-- Assurez-vous que 'description' est une colonne dans votre DB -->
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun jeu trouvé.</p>
        <?php endif; ?>
    </ul>

</body>
</html>

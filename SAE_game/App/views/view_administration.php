<?php require_once "view_begin.php" ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <!-- Tête de page avec barre de navigation -->
    <header class="nav-header">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e24d432f71ae5fc037e972e78951ca15052e5e8c7824a911375a22f8623cb7b3?placeholderIfAbsent=true&apiKey=d20a853adbac4dde9b424a402120db37" alt="Games Collection Logo" class="logo">
        <nav class="nav-links">
            <a href="index.html">Accueil</a>
            <a href="#">Catégories</a>
            <a href="decouvrir.html">Découvrir</a>
            <a href="compte.html">Mon Compte</a>
        </nav>
    </header>

    <!-- Section principale -->
    <div class="container">
        <h1>Panneau d'administration</h1>
        <div class="admin-sections">
            <!-- Gestion des jeux -->
            <div class="admin-section">
                <h2>Gestion des jeux</h2>
                <button class="Bouton">Ajouter un jeu</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Jeu de stratégie</td>
                            <td>Stratégie</td>
                            <td>
                                <button class="Bouton">Modifier</button>
                                <button class="Bouton Noir">Supprimer</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jeu familial</td>
                            <td>Famille</td>
                            <td>
                                <button class="Bouton">Modifier</button>
                                <button class="Bouton Noir">Supprimer</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Gestion des utilisateurs -->
            <div class="admin-section">
                <h2>Gestion des utilisateurs</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dupont</td>
                            <td>dupont@example.com</td>
                            <td>
                                <button class="Bouton Noir">Supprimer</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Durand</td>
                            <td>durand@example.com</td>
                            <td>
                                <button class="Bouton Noir">Supprimer</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Gestion des réservations -->
            <div class="admin-section">
                <h2>Gestion des réservations</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom du jeu</th>
                            <th>Utilisateur</th>
                            <th>Date</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Jeu de stratégie</td>
                            <td>Dupont</td>
                            <td>10/01/2025</td>
                            <td>Confirmée</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jeu familial</td>
                            <td>Durand</td>
                            <td>15/01/2025</td>
                            <td>En attente</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    <footer>
        <div class="colonne">
            <h4>À propos</h4>
            <ul>
                <li><a href="#">Mention légales</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
<?php require_once "view_end.php" ?>
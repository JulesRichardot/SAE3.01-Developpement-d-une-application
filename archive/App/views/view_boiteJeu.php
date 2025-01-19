<?php require_once "view_begin.php" ?>
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
<?php require_once "view_end.php" ?>
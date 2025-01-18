<?php require_once "view_begin.php" ?>


<div class="container">
        <h1>Panneau d'administration</h1>

        <?php if ($role === 'Admin' || $role === 'Gestionnaire'): ?>
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
                        <?php foreach ($jeux as $jeu): ?>
                            <tr>
                                <td><?= htmlspecialchars($jeu['id_jeu']) ?></td>
                                <td><?= htmlspecialchars($jeu['nom']) ?></td>
                                <td><?= htmlspecialchars($jeu['categorie']) ?></td>
                                <td>
                                    <button class="Bouton">Modifier</button>
                                    <button class="Bouton Noir">Supprimer</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if ($role === 'admin'): ?>
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
                        <?php foreach ($utilisateurs as $utilisateur): ?>
                            <tr>
                                <td><?= htmlspecialchars($utilisateur['id_utilisateur']) ?></td>
                                <td><?= htmlspecialchars($utilisateur['nom']) ?></td>
                                <td><?= htmlspecialchars($utilisateur['email']) ?></td>
                                <td>
                                    <button class="Bouton Noir">Supprimer</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <?php if ($role === 'admin' || $role === 'gestionnaire'): ?>
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
                        <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <td><?= htmlspecialchars($reservation['id_reservation']) ?></td>
                                <td><?= htmlspecialchars($reservation['nom_jeu']) ?></td>
                                <td><?= htmlspecialchars($reservation['utilisateur']) ?></td>
                                <td><?= htmlspecialchars($reservation['date_reservation']) ?></td>
                                <td><?= htmlspecialchars($reservation['statut']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
<?php require_once "view_end.php" ?>

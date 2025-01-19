<?php require_once "view_begin.php" ?>

<div class="container">
    <h1>Panneau d'administration</h1>
    <?php if ($role === 'Admin'): ?>
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
                            <td><?= htmlspecialchars($utilisateur['utilisateur_id']) ?></td>
                            <td><?= htmlspecialchars($utilisateur['nom']) ?></td>
                            <td><?= htmlspecialchars($utilisateur['email']) ?></td>
                            <td>
                                <!-- Lien vers l'action form_update_user avec l'ID de l'utilisateur -->
                                <a href="index.php?controller=set&action=form_update_user&id=<?= $utilisateur['utilisateur_id'] ?>" class="Bouton">Modifier</a>
                                <a href="index.php?controller=set&action=supprimer&id=<?= $utilisateur['utilisateur_id'] ?>" class="Bouton">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once "view_end.php" ?>

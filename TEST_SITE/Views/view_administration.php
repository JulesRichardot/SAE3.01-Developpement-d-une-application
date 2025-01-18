<?php require_once "view_begin.php" ?>


<div class="container">
        
        <h1>Panneau d'administration</h1>
        <!-- Bouton d'accès gestion réservations -->
        <?php if ($_SESSION['utilisateur']['role'] === 'Admin' || $_SESSION['utilisateur']['role'] === 'Gestionnaire'): ?>
	    <div class="admin-button">
		<a href="index.php?controller=administration&action=administrationReservation" class="Bouton">Gestion des réservations</a>
        <!-- Bouton d'accès gestion utilisateurs -->
        <?php if ($_SESSION['utilisateur']['role'] === 'Admin'): ?>
		<a href="index.php?controller=administration&action=administrationUtilisateur" class="Bouton">Gestion des utilisateurs</a>
        </div>
        <?php endif; ?>

        <?php endif; ?>
        
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
                                <td><?= htmlspecialchars($jeu['titre']) ?></td>
                                <td><?= htmlspecialchars($jeu['categories']) ?></td>
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

<?php require_once "view_end.php" ?>

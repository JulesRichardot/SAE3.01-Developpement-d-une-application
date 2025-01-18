<?php require_once "view_begin.php" ?>


<?php if ($role === 'Admin' || $role === 'Gestionnaire'): ?>
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

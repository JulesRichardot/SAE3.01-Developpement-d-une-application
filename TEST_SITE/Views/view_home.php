<?php require_once "view_begin.php" ?>

<section id="presentation">
    <div>
        <h1>Chercher un jeu parmi nos <?= htmlspecialchars($nb_jeux) ?> jeux !</h1> <!-- Affichage du nombre total de jeux -->
        <input type="search" placeholder="Rechercher un jeu par titre ou catégories">
    </div>

    <div id="presentation">
        <h1>Collection de jeux de sociétés</h1>
        <h4>Découvrez et gérez votre collection de jeux de sociétés</h4>
        <input type='button' class="Bouton" value="Découvrir"/>
        <input type='button' class="Bouton" value="Catégories"/>
    </div>

    <h1>Nos 10 jeux les plus populaires chez nos utilisateurs !</h1>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Nombre d'emprunts</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jeux as $jeu): ?>
                <tr>
                    <td><a href="?controller=list&action=jeuPresentation&id_jeu=<?= $jeu['id_jeu'] ?>"><?= htmlspecialchars($jeu['titre']) ?></a></td>
                    <td><?= htmlspecialchars($jeu['nombre_emprunts']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require_once 'view_end.php'; ?>

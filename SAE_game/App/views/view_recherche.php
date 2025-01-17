<?php require_once "view_begin.php" ?>

<div class="container">
    <h1>Recherche de Jeux</h1>
    
    <!-- Formulaire de recherche -->
    <form class="recherche" action="#" method="GET">
        <div class="form-group">
            <label for="terme">Mot-clé</label>
            <input type="text" id="terme" name="terme" placeholder="Rechercher par titre ou mots-clés">
        </div>
        <div class="form-group">
            <button type="submit" class="Bouton">Rechercher</button>
        </div>
    </form>

    <?php if (isset($resultats) && !empty($resultats)): ?>
        <h2>Résultats de la recherche</h2>
        <ul>
            <?php foreach ($resultats as $jeu): ?>
                <li>
                    <strong><?php echo htmlspecialchars($jeu['titre']); ?></strong> - <?php echo htmlspecialchars($jeu['mots_cles']); ?>
                    <br>
                    <a href="jeu_presentation.php?jeu=<?php echo urlencode($jeu['titre']); ?>">Voir détails</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif (isset($_GET['terme']) && empty($resultats)): ?>
        <p>Aucun jeu trouvé pour le mot-clé "<?php echo htmlspecialchars($_GET['terme']); ?>".</p>
    <?php endif; ?>
</div>

<?php require_once "view_end.php" ?>

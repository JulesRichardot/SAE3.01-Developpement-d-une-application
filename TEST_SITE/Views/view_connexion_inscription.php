<?php require_once "view_begin.php"; ?>

<section id="connexion_inscription">
    <!-- Section Connexion -->
    <div class="connexion">
        <h2>Connexion</h2>
        <?php if (!empty($erreur)): ?>
            <p class="error"><?= htmlspecialchars($erreur) ?></p>
        <?php endif; ?>
        <form action="?controller=connexion_inscription&action=connexion" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Votre email" required>

            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" required>

            <button type="submit" class="Bouton">Se connecter</button>
        </form>
    </div>

    <!-- Section Inscription -->
    <div class="inscription">
        <h2>Inscription</h2>
        <?php if (!empty($succes)): ?>
            <p class="success"><?= htmlspecialchars($succes) ?></p>
        <?php endif; ?>
        <form action="?controller=connexion_inscription&action=inscription" method="post">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Votre nom" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Votre email" required>

            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" required>

            <button type="submit" class="Bouton">S'inscrire</button>
        </form>
    </div>
</section>

<?php require_once "view_end.php"; ?>

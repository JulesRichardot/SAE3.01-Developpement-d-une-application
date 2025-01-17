<?php require_once "view_begin.php"; ?>

<section id="connexion_inscription">
    <!-- Section Connexion -->
    <div class="connexion">
        <h2>Connexion</h2>
        <?php if (!empty($_GET['erreur_connexion'])): ?>
            <p class="error"><?= htmlspecialchars($_GET['erreur_connexion']) ?></p>
        <?php endif; ?>
        <form action="?controller=connexion_inscription&action=connexion" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Votre email" value="<?= htmlspecialchars($_GET['connexion_email'] ?? '') ?>" required>

            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" required>

            <button type="submit" class="Bouton">Se connecter</button>
        </form>
    </div>

    <!-- Section Inscription -->
    <div class="inscription">
        <h2>Inscription</h2>
        <?php if (!empty($_GET['erreur_inscription'])): ?>
            <p class="error"><?= htmlspecialchars($_GET['erreur_inscription']) ?></p>
        <?php endif; ?>
        <?php if (!empty($_GET['succes'])): ?>
            <p class="success"><?= htmlspecialchars($_GET['succes']) ?></p>
        <?php endif; ?>
        <form action="?controller=connexion_inscription&action=inscription" method="post">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Votre nom" value="<?= htmlspecialchars($_GET['inscription_nom'] ?? '') ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Votre email" value="<?= htmlspecialchars($_GET['inscription_email'] ?? '') ?>" required>

            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" required>

            <button type="submit" class="Bouton">S'inscrire</button>
        </form>
    </div>
</section>

<?php require_once "view_end.php"; ?>

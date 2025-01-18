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
            <input type="email" id="email" name="email" placeholder="Votre email"
                value="<?= htmlspecialchars($_GET['connexion_email'] ?? '') ?>" required>

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
            <input type="text" id="nom" name="nom" placeholder="Votre nom" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Votre email" required>

            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" required>
            <?php if (!empty($erreur) && strpos($erreur, 'Le mot de passe doit contenir') !== false): ?>
                <p class="error"><?= htmlspecialchars($erreur) ?></p>
            <?php endif; ?>


            <!-- Section pour les informations complémentaires -->
            <h3>Informations pour les emprunteurs</h3>
            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" name="telephone" placeholder="Votre numéro de téléphone">

            <label for="adresse">Adresse</label>
            <textarea id="adresse" name="adresse" placeholder="Votre adresse"></textarea>

            <label for="date_naissance">Date de naissance</label>
            <input type="date" id="date_naissance" name="date_naissance">

            <button type="submit" class="Bouton">S'inscrire</button>
        </form>

    </div>
</section>

<?php require_once "view_end.php"; ?>

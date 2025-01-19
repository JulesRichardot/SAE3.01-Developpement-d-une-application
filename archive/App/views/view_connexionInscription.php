<?php require_once "view_begin.php" ?>
<div class="container">
    <div class="connexion-inscription">
        <!-- Section Connexion -->
        <div class="connexion">
            <h2>Connexion</h2>
            <form action="#" method="post">
                <label for="email-connexion">Email</label>
                <input type="email" id="email-connexion" name="email" placeholder="Votre email" required>

                <label for="password-connexion">Mot de passe</label>
                <input type="password" id="password-connexion" name="password" placeholder="Votre mot de passe" required>

                <button type="submit" class="Bouton nav-link">Se connecter</button>
                <a href="#" class="lien">Mot de passe oublié ?</a>
            </form>
        </div>

        <!-- Section Inscription -->
        <div class="inscription">
            <h2>Inscription</h2>
            <form action="#" method="post">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" required>

                <label for="email-inscription">Email</label>
                <input type="email" id="email-inscription" name="email" placeholder="Votre email" required>

                <label for="password-inscription">Mot de passe</label>
                <input type="password" id="password-inscription" name="password" placeholder="Votre mot de passe" required>

                <button type="submit" class="Bouton nav-link">S'inscrire</button>
            </form>
        </div>
    </div>
</div>
<?php require_once "view_end.php" ?>

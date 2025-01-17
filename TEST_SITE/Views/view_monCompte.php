<?php require_once "view_begin.php"; ?>

<div class="container">
    <div class="mon-compte-section">
        <h2>Mon Compte</h2>
        <div class="account-info">
            <h3>Informations du compte</h3>
            <p><strong>Nom:</strong> <?= htmlspecialchars($utilisateur['nom']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($utilisateur['email']) ?></p>
            <p><strong>Rôle:</strong> <?= htmlspecialchars($utilisateur['role']) ?></p>

            <button class="Bouton">Modifier les informations</button>
            <button class="Bouton">Changer le mot de passe</button>
        </div>
    </div>
</div>

<?php require_once "view_end.php"; ?>

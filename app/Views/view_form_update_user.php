<?php require_once "view_begin.php" ?>

<div class="container">
    <h1>Modifier l'utilisateur</h1>
    
    <!-- Formulaire de modification -->
    <form action="index.php?controller=set&action=update_user" method="POST">
        <input type="hidden" name="utilisateur_id" value="<?= htmlspecialchars($data['utilisateur_id']) ?>">
        
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($data['nom']) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="role">Rôle :</label>
            <select id="role" name="role" required>
                <option value="User" <?= $data['role'] === 'User' ? 'selected' : '' ?>>User</option>
                <option value="Admin" <?= $data['role'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
                <option value="Gestionnaire" <?= $data['role'] === 'Gestionnaire' ? 'selected' : '' ?>>Gestionnaire</option>
            </select>
        </div>
        
        <div class="form-group">
            <button type="submit">Modifier</button>
        </div>
    </form>
</div>

<?php require_once "view_end.php" ?>

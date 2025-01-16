<?php require_once "view_begin.php"?>

    <!-- Présentation du jeu -->
    <div class="container">
        <!-- Section gauche -->
        <div class="section-gauche">
            <div class="game-image"></div>
            <p><strong>Nombre d'exemplaires :</strong> <?php echo $nb_boite["nb_boite"]?></p>
            <button class="Bouton">Voir les boîtes</button>
        </div>

        <!-- Section droite -->
        <div class="info-section">
            <h1><?php echo $unJeux["titre"]?></h1>
            <p><span>Éditeur :</span> <?php echo $unJeux["nom_editeur"]?></p>
            <p><span>Auteur :</span> <?php echo $unJeux["nom_auteur"]?></p>
            <p><span>Âge : </span><?php echo $unJeux["age_indique"]?> ans</p>
            <p><span>Nombre de joueurs :</span> <?php echo $unJeux["nombre_de_joueurs"]?> joueurs</p>
            <p><span>Date de parution :</span> <?php echo $unJeux["date_parution_debut"]?></p>
            <p><span>Mécanisme :</span><?php echo $unJeux["nom_mecanisme"]?> </p>
            <p><span>Version :</span> <?php echo $unJeux["version"]?></p>
            <p><span>Mots-clés :</span> <?php echo $unJeux["mots_cles"]?></p>
        </div>
    </div>

    <!-- Section des jeux similaires -->
    <div class="jeux-similaires">
        <h2>Autres jeux similaires :</h2>
        <div class="cards">
            <div class="card">
                <h3>Titre du jeu</h3>
                <p>Catégorie du jeu</p>
                <p>Nombre d'exemplaires disponibles.</p>
            </div>
            <div class="card">
                <h3>Titre du jeu</h3>
                <p>Catégorie du jeu</p>
                <p>Nombre d'exemplaires disponibles.</p>
            </div>
            <div class="card">
                <h3>Titre du jeu</h3>
                <p>Catégorie du jeu</p>
                <p>Nombre d'exemplaires disponibles.</p>
            </div>
        </div>
    </div>

<?php require_once "view_end.php"?>

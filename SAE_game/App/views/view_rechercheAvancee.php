<?php require_once "view_begin.php" ?>
<div class="container">
    <h1>Recherche Avancée</h1>
    <form class="recherche-avancee" action="#" method="GET">
        <div class="form-group">
            <label for="titre-jeu">Titre du jeu</label>
            <input type="text" id="titre-jeu" name="titre-jeu" placeholder="Rechercher par titre">
        </div>
        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <select id="categorie" name="categorie">
                <option value="">Toutes les catégories</option>
                <option value="strategie">Stratégie</option>
                <option value="famille">Famille</option>
                <option value="coop">Coopératif</option>
                <option value="rapide">Rapide</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nb-joueurs">Nombre de joueurs</label>
            <input type="number" id="nb-joueurs" name="nb-joueurs" placeholder="Ex: 2">
        </div>
        <div class="form-group">
            <label for="duree-partie">Durée de la partie (en minutes)</label>
            <input type="number" id="duree-partie" name="duree-partie" placeholder="Ex: 30">
        </div>
        <div class="form-group">
            <label for="date-sortie">Date de sortie</label>
            <input type="date" id="date-sortie" name="date-sortie">
        </div>
        <div class="form-group">
            <button type="submit" class="Bouton">Rechercher</button>
        </div>
    </form>
</div>
<?php require_once "view_end.php" ?>
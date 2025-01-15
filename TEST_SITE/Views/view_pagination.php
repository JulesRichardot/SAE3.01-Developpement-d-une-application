<?php require "view_begin.php"?>

<section id="pagination">
    <h1>Liste des jeux - Page <?= $active ?></h1>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Mots Clés</th>
                <th>Date de publication</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jeux as $jeu): ?>
                <tr>
                    <td><?= htmlspecialchars($jeu['titre']) ?></td>
                    <td><?= htmlspecialchars($jeu['mots_cles']) ?></td>
                    <td><?= htmlspecialchars($jeu['date_parution_debut']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="listePages">
        <p> Pages: </p>
        <?php if ($active > 1) : ?>
            <a href="?controller=list&action=pagination&start=<?=$active - 1 ?>"> <img class="icone" src="Content/img/previous-icon.png" alt="Previous" /> </a>
        <?php endif ?>

        <?php for($p = $debut; $p <= $fin; $p++): ?>

            <a class="<?= $p == $active ? "lienStart active" : "lienStart" ?>" href="?controller=list&action=pagination&start=<?= $p ?>"> <?= $p ?> </a>
        <?php endfor ?> 

        <?php if ($active < $nb_total_pages) : ?>
            <a href="?controller=list&action=pagination&start=<?= $active + 1 ?>"> <img class="icone" src="Content/img/next-icon.png" alt="Next" /> </a>
        <?php endif ?>
    </div>
</section>

<?php require_once "view_end.php"; ?>

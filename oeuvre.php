<?php
    require_once 'header.php';
    require_once 'bdd.php';

    if(empty($_GET['id'])) {
        header('Location: index.php');
        return;
    }

    $db = connexion();

    $req = $db->prepare('SELECT * FROM oeuvres WHERE id = ?');
    $req->execute([intval($_GET['id'])]);
    $oeuvre = $req->fetch();


    // Si aucune oeuvre trouvé, on redirige vers la page d'accueil
    if(!$oeuvre) {
        header('Location: index.php');
    }
?>

<article id="detail-oeuvre">
    <div class="img-container-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
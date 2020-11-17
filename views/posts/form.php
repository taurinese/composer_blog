<?php $title = "My blog"; ?>
<?php ob_start(); ?>
<div class="d-flex justify-content-center align-items-center" style="height:80vh">
    <form action="<?= $_SESSION['form_action'] == "create" ? "/articles" : "/articles/edit?id=" . $_GET['id'] ?>" method="post">
        <label for="title">Titre :</label>
        <input class="mb-3" type="text" name="title" id="title" value="<?php if(isset($_SESSION['old_inputs']['title'])): ?><?= $_SESSION['old_inputs']['title'] ?> <?php elseif(isset($post->title)): ?> <?= $post->title ?> <?php endif; ?>"> <br>
        <label for="body">Contenu :</label>
        <input class="mb-3" type="text" name="body" id="body" value="<?php if(isset($_SESSION['old_inputs']['body'])): ?><?= $_SESSION['old_inputs']['body'] ?> <?php elseif(isset($post->body)): ?> <?= $post->body ?> <?php endif; ?>"> <br>
        <button class="btn btn-info" type="submit"><?= $_SESSION['form_action'] == "create" ? "Créer" : "Modifier" ?></button>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/default.php'; ?>
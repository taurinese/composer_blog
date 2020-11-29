<?php $this->layout('layouts/default', ['title' => $_SESSION['form_action'] == "create" ? "Créer post" : "Éditer post"]) ?>
<div class="d-flex justify-content-center align-items-center" style="height:80vh">
    <form action="<?= $_SESSION['form_action'] == "create" ? "/articles" : "/articles/" . $id ?>" method="post">
        <?php if($_SESSION['form_action'] == "edit"): ?>
            <input type="hidden" name="_method" value="PUT">
        <?php endif; ?>
        <label for="title">Titre :</label>
        <input class="mb-3" type="text" name="title" id="title" value="<?php if(isset($_SESSION['old_inputs']['title'])): ?><?= $_SESSION['old_inputs']['title'] ?> <?php elseif(isset($post->title)): ?> <?= $post->title ?> <?php endif; ?>"> <br>
        <?php if(isset($post)): ?>
            <p>Créé: <?= $post->created_at ?></p>
        <?php endif; ?>
        <label for="body">Contenu :</label>
        <input class="mb-3" type="text" name="body" id="body" value="<?php if(isset($_SESSION['old_inputs']['body'])): ?><?= $_SESSION['old_inputs']['body'] ?> <?php elseif(isset($post->body)): ?> <?= $post->body ?> <?php endif; ?>"> <br>
        <button class="btn btn-info" type="submit"><?= $_SESSION['form_action'] == "create" ? "Créer" : "Modifier" ?></button>
    </form>
</div>

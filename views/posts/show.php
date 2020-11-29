<?php $this->layout('layouts/default', ['title' => $post->title]) ?>


<button class="btn btn-primary m-4"><a href="/">Retour à l'accueil</a></button>

<div class="card">
    <div class="card-body text-center">
        <h1 class="card-title"><?= $post->title ?></h1>
        <p class="card-subtitle"><?= $post->created_at ?></p>
        <p class="card-text"><?= $post->body ?></p>
    </div>
</div>

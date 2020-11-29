<?php $this->layout('layouts/nav_blog', ['title' => "Mon blog"]) ?>
<div class="list-group">
<?php foreach($posts as $post): ?>
    <a href="/articles/<?= $post->id ?>" class="list-group-item list-group-item-action"><?= $post->title ?></a>
<?php endforeach; ?>
</div>
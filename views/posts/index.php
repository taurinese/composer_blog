<?php $this->layout('layouts/default', ['title' => 'Mon blog']) ?>
<table class="table text-center">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Date</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($posts as $post): ?>
        <tr>
            <td><?= $post->id ?></td>
            <td><a role="button" href="/articles/<?= $post->id ?>"><?= $post->title ?></a>  </td>
            <td><?= $post->created_at_fr ?></td>
            <td class="d-flex flex-md-wrap justify-content-around align-items-center flex-row"><button class="btn btn-primary"><a href="/articles/<?= $post->id ?>/edit">Modifier</a></button>
                <form action="/articles/<?= $post->id ?>" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger" type="submit" onclick="confirm('Are you sure?')">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>

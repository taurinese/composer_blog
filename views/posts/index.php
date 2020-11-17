<?php $title = "My blog"; ?>
<?php ob_start(); ?>
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
            <td><a role="button" href="/articles/show?id=<?= $post->id ?>"><?= $post->title ?></a>  </td>
            <td><?= $post->created_at_fr ?></td>
            <td class="d-flex flex-md-wrap justify-content-around align-items-center flex-row"><button class="btn btn-primary"><a href="/articles/edit?id=<?= $post->id ?>">Modifier</a></button>
                <form action="/articles/delete?id=<?= $post->id ?>" method="post">
                    <button class="btn btn-danger" type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . "/../layouts/default.php" ?>
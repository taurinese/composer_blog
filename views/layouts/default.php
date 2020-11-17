<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <style>
        button > a {
            color:white !important;
            text-decoration:none;
        }
        body {
            margin:0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light mx-auto">
        <h1 class="mx-auto"><a href="/articles">My blog</a></h1>
        <button class="btn btn-primary mx-auto"><a href="/articles/create">Ajouter un article</a></button>
    </nav>
    <?php if(isset($_SESSION['alert']['content'])): ?>
        <?php foreach($_SESSION['alert']['content'] as $alert): ?>
            <div class="alert alert-<?= $_SESSION['alert']['success'] ? 'success' : 'danger' ?>"> <?= $alert ?></div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?= $content ?>
</body>
</html>
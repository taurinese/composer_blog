<?php

function postIndex()
{
    $posts = getAllPosts();
    view('posts/index.php', compact('posts'));
}

function postShow($id)
{
    if (empty($id)){
        http_response_code(400);
        echo '<html><body>Bad request</body></html>';
        return;
    }

    $post = getPostById($id);

    if(!$post){
        http_response_code(404);
        echo '<html><body>Post not found</body></html>';
        return;
    }

    view('posts/show.php', compact('post'));
}

function postCreate()
{
    $_SESSION['form_action'] = "create";
    view('posts/form.php', []);
}
function postStore()
{
    if(!isset($_POST['title']) or empty($_POST['title'])
    or !isset($_POST['body']) or empty($_POST['body'])){
        // Renvoyer sur le formulaire avec les old_inputs en session
        if(isset($_POST['title']) and !empty($_POST['title'])){
            $_SESSION['old_inputs']['title'] = $_POST['title'];
        }
        else{
            $_SESSION['alert']['content'][] = "Le titre est obligatoire.";
        }
        if(isset($_POST['body']) and !empty($_POST['body'])){
            $_SESSION['old_inputs']['body'] = $_POST['body'];
        }
        else{
            $_SESSION['alert']['content'][] = "Le corps est obligatoire.";
        }
        $_SESSION['alert']['success'] = false;
        header('Location:/articles/create');
        exit();
    }
    else{
        createPost($_POST);
        $_SESSION['alert'] = [
            'success' => true,
            'content' => ["L'article a été correctement ajouté!"]
        ];
        header('Location:/articles');
        exit();
    }
}
function postEdit($id)
{
    if (empty($id)){
        http_response_code(400);
        echo '<html><body>Bad request</body></html>';
        return;
    }
    $post = getPostById($id);
    if(!$post){
        http_response_code(404);
        echo '<html><body>Post not found</body></html>';
        return;
    }
    $_SESSION['form_action'] = "edit";
    view('posts/form.php', compact('post'));
}
function postUpdate($id)
{
    if(!isset($_POST['title']) or empty($_POST['title'])
    or !isset($_POST['body']) or empty($_POST['body'])){
        // Renvoyer sur le formulaire avec les old_inputs en session
        if(isset($_POST['title']) and !empty($_POST['title'])){
            $_SESSION['old_inputs']['title'] = $_POST['title'];
        }
        else{
            $_SESSION['alert']['content'][] = "Le titre est obligatoire.";
        }
        if(isset($_POST['body']) and !empty($_POST['body'])){
            $_SESSION['old_inputs']['body'] = $_POST['body'];
        }
        else{
            $_SESSION['alert']['content'][] = "Le corps est obligatoire.";
        }
        $_SESSION['alert']['success'] = false;
        header('Location:/articles/edit?id=' . $_GET['id']);
        exit();
    }
    else{
        updatePostById($id, $_POST);
        $_SESSION['alert'] = [
            'success' => true,
            'content' => ["L'article a été correctement modifié!"]
        ];
        header('Location:/articles');
        exit();
    }
}
function postDestroy($id)
{
    if (empty($id)){
        http_response_code(400);
        echo '<html><body>Bad request</body></html>';
        return;
    }
    $post = getPostById($id);
    if(!$post){
        http_response_code(404);
        echo '<html><body>Post not found</body></html>';
        return;
    }
    deletePostById($id);
    $_SESSION['alert'] = [
        'success' => true,
        'content' => ["L'article a été correctement supprimé!"]
    ];
    header('Location:/articles');
    exit();
}

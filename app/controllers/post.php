<?php

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

function postHome()
{
    $posts = getAllPosts();
    view('posts/blog', compact('posts'));
}


function postIndex()
{
    $posts = getAllPosts();
    view('posts/index', compact('posts'));
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

    view('posts/show', compact('post'));
}

function postCreate()
{
    $_SESSION['form_action'] = "create";
    view('posts/form', []);
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
        $contentValidator = v::attribute('title', v::stringType()->length(1, 255)) // car varchar de 255 en db
                  ->attribute('body', v::stringType()->length(1, null));

        try {
            $contentValidator->assert((object) $_POST);
        } catch (NestedValidationException $exception) {
            $_SESSION['alert'] = [
                'success' => false,
                'content' => ["Erreur lors de la validation des données."]
            ];
            $_SESSION['old_inputs'] = $_POST;
            header('Location:/articles/create');
            exit();
        }
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
    view('posts/form', compact('post','id'));
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
        header('Location:/articles/' . $id . '/edit');
        exit();
    }
    else{
        $contentValidator = v::attribute('title', v::stringType()->length(1, 255)) // car varchar de 255 en db
                    ->attribute('body', v::stringType()->length(1, null));
        try {
        $contentValidator->assert((object) $_POST);
        } catch (NestedValidationException $exception) {
        $_SESSION['alert'] = [
            'success' => false,
            'content' => ["Erreur lors de la validation des données."]
        ];
        $_SESSION['old_inputs'] = $_POST;
        header('Location:/articles/' . $id . '/edit');
        exit();
        }
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

function postFaker($nb)
{
    $continue = true;
    for ($i=0; $i < $nb; $i++) { 
        $faker = Faker\Factory::create();
        $fakeData = [
            'title' => $faker->name,
            'body' => $faker->text
        ];
        $result = createPost($fakeData);
        if(!$result){
            !$continue;
            return;
        }
    }
    if($continue){
        $_SESSION['alert'] = [
            'success' => true,
            'content' => ["Les articles ont été correctement ajoutés!"]
        ];
    }
    else{
        $_SESSION['alert'] = [
            'success' => false,
            'content' => ["Erreur lors de l'insertion!"]
        ];
    }
    header('Location:/articles');
    exit();
}
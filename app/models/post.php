<?php

use Carbon\Carbon;

function getAllPosts() 
{
    $db = dbConnect();

    $query = $db->query('SELECT id, title, DATE_FORMAT(created_at, "%d/%m/%y") as created_at_fr FROM posts');
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getPostById($id)
{
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $query->execute(['id' => $_GET['id']]);
    $post = $query->fetchObject();
    if($post){
        $post->created_at = ucfirst(Carbon::parse($post->created_at,'Europe/Paris')->locale('fr_FR')->diffForHumans());
    }
    return $post;
}

function createPost($post)
{
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO posts (title, body) VALUES (:title, :body)');
    return $query->execute([
        "title" => $post['title'],
        "body"=> $post['body']
    ]);
}

function updatePostById($id, $data)
{
    $db = dbConnect();
    $query = $db->prepare('UPDATE posts SET title = :title, body = :body WHERE id = :id');
    return $query->execute([
        "title" => $data['title'],
        "body"=> $data['body'],
        "id" => $id
    ]);
}

function deletePostById($id)
{
    $db = dbConnect();
    $query = $db->prepare('DELETE FROM posts WHERE id = :id');
    return $query->execute([ "id" => $id ]);
}
<?php 

function dbConnect(){

    try {
        return new PDO("{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8", "{$_ENV['DB_USER']}", "{$_ENV['DB_PASSWORD']}", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); //affichage des erreurs
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
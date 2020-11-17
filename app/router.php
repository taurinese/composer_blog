<?php

/* if(isset($_SESSION['alert'])){
    unset($_SESSION['alert']);
} */



$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if($_SERVER['REQUEST_METHOD'] == "GET"){
    if($uri == "/articles"){
        postIndex();
    }
    elseif($uri == "/articles/show" and isset($_GET['id'])){
        postShow($_GET['id']);
    }
    elseif($uri == "/articles/create"){
        postCreate();
    }
    elseif($uri == "/articles/edit" and isset($_GET['id'])){
        postEdit($_GET['id']);
    }
    else{
        http_response_code(404);
        echo '<html><body>Page not found</body></html>';
        return;
    }
}
elseif($_SERVER['REQUEST_METHOD'] == "POST"){
    if($uri == "/articles"){
        postStore();
    }
    elseif($uri == "/articles/edit"){
        postUpdate($_GET['id']);
    }
    elseif($uri == "/articles/delete" and isset($_GET['id'])){
        postDestroy($_GET['id']);
    }
    else{
        http_response_code(404);
        echo '<html><body>Page not found</body></html>';
        return;
    }
}
else{
    http_response_code(405);
    echo '<html><body>Method not allowed</body></html>';
    return;
}

if(isset($_SESSION['alert'])){
    unset($_SESSION['alert']);
}
if(isset($_SESSION['old_inputs'])){
    unset($_SESSION['old_inputs']);
}
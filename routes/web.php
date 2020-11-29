<?php

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->get('/', 'postHome');
    $r->get('/articles', 'postIndex');
    $r->get('/articles/create', 'postCreate');
    $r->get('/articles/{id:[0-9]+}/edit', 'postEdit');
    $r->get('/articles/{id:[0-9]+}', 'postShow');
    $r->get('/generate/{nb:[0-9]+}', 'postFaker');
    $r->post('/articles', 'postStore');
    $r->put('/articles/{id:[0-9]+}', 'postUpdate');
    $r->delete('/articles/{id:[0-9]+}', 'postDestroy');
});
<?php
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../core/initialize.php');

    $post = new Post($db);
    
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();
    
    $post->read_single();
    $post_arr = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => html_entity_decode($post->body),
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name,
        'created_at' => $post->created_at
    );
    echo json_encode($post_arr);
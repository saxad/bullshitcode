<?php
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Acces-Control-Allow-Methods: PUT');
    header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Authorization, Content-Type, Acces-Control-Allow-Methods');

    
    include_once('../core/initialize.php');

    $post = new Post($db);
    $data =  json_decode(file_get_contents('php://input'));
    
    $post->id = $data->id;
    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;
    $post->created_at = $data->created_at;

    if ( $post->update()){
        echo json_encode(
            array('message'=>'post updated')
        );
    }else{
        echo json_encode(
            array('message'=>'post not updated')
        );
    }

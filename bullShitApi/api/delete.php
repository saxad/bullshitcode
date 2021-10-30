<?php
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Acces-Control-Allow-Methods: DELETE');
    header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Authorization, Content-Type, Acces-Control-Allow-Methods');

    
    include_once('../core/initialize.php');

    $post = new Post($db);
    $data =  json_decode(file_get_contents('php://input'));
    
    $post->id = $data->id;
    
    if ( $post->delete()){
        echo json_encode(
            array('message'=>'post  deleted')
        );
    }else{
        echo json_encode(
            array('message'=>'post not deleted')
        );
    }

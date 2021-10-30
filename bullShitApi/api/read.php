<?php
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../core/initialize.php');

    $post = new Post($db);

    $book = $post->read();
   
    
    
    //var_dump($book);

    $num = $book->rowCount();
    if ($num > 0){
        $post_arr = array();
        $post_arr['data'] = array();
        while ($row = $book->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name,
                'created_at' => $created_at
            );
            array_push($post_arr['data'], $post_item);
        }
        // encode array to json 
        echo json_encode($post_arr);
    }else{
        echo json_encode(['message'=>'No post found']);
    }

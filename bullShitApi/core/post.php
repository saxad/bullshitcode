<?php

class Post{

    //db stuff
    private $conn;
    private $table = 'posts';

    //post propreties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // constructor with db connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        try{
            $query =    'SELECT 
                        c.name as category_name,
                        p.id,
                        p.category_id,
                        p.title,
                        p.body,
                        p.author,
                        p.created_at
                    FROM '
                        .$this->table . ' p 
                    LEFT JOIN
                        categories c ON p.category_id = c.id
                        ORDER BY p.created_at DESC';

            // prepare stmt                        
            $stmt = $this->conn->prepare($query);
            //execute stmt
            $stmt->execute();
            return $stmt;
        }
        catch(Exception $e){
            echo "error" . $e->getMessage();
            echo '<br>';
            echo "error" . $e->getFile();
            echo '<br>';
            echo "error" . $e->getLine();
        }
        
    }

    public function read_single(){
        $query = 'SELECT 
                        c.name as category_name,
                        p.id,
                        p.category_id,
                        p.title,
                        p.body,
                        p.author,
                        p.created_at
                 FROM '
                    .$this->table . ' p 
                 LEFT JOIN
                    categories c ON p.category_id = c.id
                 WHERE p.id = ?
                 LIMIT 1';

        // prepare stmt                        
        $stmt = $this->conn->prepare($query);
        //execute stmt
        $stmt->execute([$this->id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->title = $result['title'];
        $this->category_id = $result['category_id'];
        $this->category_name = $result['category_name'];
        $this->body = $result['body'];
        $this->author = $result['author'];
        $this->created_at = $result['created_at'];
    }

    public function create(){
        $query = 'INSERT INTO ' . $this->table. ' (title, body, author, category_id, created_at) 
        VALUES (?,?,?,?,?)'; 

        $stmt = $this->conn->prepare($query);
        $exec_status = $stmt->execute(
            [
                $this->title, 
                $this->body, 
                $this->author, 
                $this->category_id, 
                $this->created_at
            ]);
        if ($exec_status){
            return true;
        }
        // print error if something goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    public function update(){
        try {
            $query = 'UPDATE ' . $this->table. ' SET title=?, body=?, author=?, category_id=?, created_at=? 
        WHERE id=?'; 
        
            $stmt = $this->conn->prepare($query);
            $exec_status = $stmt->execute(
                [
                    $this->title, 
                    $this->body, 
                    $this->author, 
                    $this->category_id, 
                    $this->created_at,
                    $this->id
                ]);
            if ($exec_status){
                return true;
        }
        // print error if something goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            echo $th->getFile();
            echo $th->getLine();
            
        }
        
    }

    public function delete(){
        $query = 'DELETE FROM ' .$this->table. ' WHERE id=?';
        $stmt = $this->conn->prepare($query);
        $stmt_status = $stmt->execute([$this->id]);
        if ($stmt_status){
            return true;
            //echo json_encode(['message' => 'post deleted']);
        }
        printf("Error %s.\n", $stmt->error);
        return false;
    }
}

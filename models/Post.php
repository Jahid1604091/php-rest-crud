<?php
class Post
{
    //db
    private $conn;
    private $table = 'posts';

    //post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;


    //constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //get posts
    public function read()
    {
        //create query
        $query = 'SELECT 
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at
        FROM
        ' . $this->table . ' p LEFT JOIN 
        categories c ON p.category_id = c.id
        ORDER By
        p.created_at DESC
        ';

        //prepare
        $stmt = $this->conn->prepare($query);
        //execute
        $stmt->execute();

        return $stmt;
    }
}

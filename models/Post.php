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

    //get posts by id
    public function read_by_id()
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
         WHERE p.id = ? LIMIT 0,1
        ';

        //prepare
        $stmt = $this->conn->prepare($query);

        //bind id (positional)
        $stmt->bindParam(1, $this->id);

        //execute
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }
}

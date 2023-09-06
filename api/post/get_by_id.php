<?php
//Headres
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->dbConnect();
$post = new Post($db);

//get id
$post->id = isset($_GET['id']) ? $_GET['id'] : die();


//get post
$post->read_by_id();

$post = array(
    'id' => $post->id,
    'title' => $post->title,
    'author' => $post->author,
    'body' => $post->body,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name,
);

print_r(json_encode($post));

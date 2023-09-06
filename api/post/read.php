<?php
//Headres
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->dbConnect();
$post = new Post($db);

$result = $post->read();
$num = $result->rowCount();

if($num > 0 ){
    $posts = array();
    $posts ['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item = array(
            'id'=>$id,
            'title'=>$title,
            'author'=>$author,
            'body'=>html_entity_decode($body),
            'category_id'=>$category_id,
            'category_name'=>$category_name,
        );
        array_push($posts['data'],$post_item);
    }

    //convert to JSON
    echo json_encode($posts);
}
else{
    echo json_encode(
        array(
            'message'=>'No Post Found'
        )
    );
}
<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
require_once('../Config/class.database.php');
require_once('../Models/class.post.php');
$database=new Database('localhost','myblog','root','');
//$db=$database->connect();
$db=Database::connect();
$sp=new Post($db);

//get id
$sp->id=isset($_GET['id'])?$_GET['id']:die("id parameter is not set");
$sp->single_post();

$content['data']=array(
	'id'=>$sp->id,
	'category_id'=>$sp->category_id,
	'category_name'=>$sp->category_name,
	'body'=>$sp->body,
	'author'=>$sp->author,
	'created_at'=>$sp->created_at
				);
echo json_encode($content);





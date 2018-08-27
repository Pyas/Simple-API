<?php
//headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
require_once('../Config/class.database.php');
require_once('../Models/class.post.php');

//instantiate database and connect to the database
$database=new Database('localhost','myblog','root','');
$db=$database->connect();
//instantiate a blog post object
$post=new Post($db);
$result=$post->read();

$num=$result->rowCount();
//check if there is any post
if ($num>0) {
	//post array
	//$post_arr=array();
	$post_arr['data']=array();
	while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
		
		extract($row);
	
		$post_item=array(
			'id'=>$id,
			'title'=>$title,
			'body'=>html_entity_decode($body),
			'author'=>$author,
			'category_id'=>$category_id,
			'category_name'=>$category_name
		);
	
		array_push($post_arr['data'],$post_item);
	}// end of while
	echo json_encode($post_arr);

}
else{
	echo json_encode(array('message'=>'no post'));
}
?>

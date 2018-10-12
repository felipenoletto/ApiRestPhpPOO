<?php 

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	header("Access-Control-Allow-Methods: PUT");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

	include_once("../../models/Post.php");

	$post = new Post();

	$data = json_decode(file_get_contents("php://input"));

	$post->id = $data->id;
	$post->title = $data->title;
	$post->body = $data->body;
	$post->author = $data->author;
	$post->category_id = $data->category_id;

	if($post->update()) {
		$response_array = array("message" => "Post updated.");
		echo json_encode($response_array);

	} else {
		$response_array = array("message" => "Post not updated.");
		echo json_encode($response_array);

	}

?>
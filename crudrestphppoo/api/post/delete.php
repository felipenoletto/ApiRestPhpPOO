<?php

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	header("Access-Control-Allow-Methods: DELETE");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

	include_once("../../models/Post.php");

	$post = new Post();

	$data = json_decode(file_get_contents("php://input"));

	$post->id = $data->id;

	if($post->delete()) {
		$response_array = array("message" => "Post deleted.");
		echo json_encode($response_array);

	} else {
		$response_array = array("message" => "Post not deleted.");
		echo json_encode($response_array);

	}

?>
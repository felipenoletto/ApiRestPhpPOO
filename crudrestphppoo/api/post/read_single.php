<?php

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	header("Access-Control-Allow-Methods: GET");

	include_once("../../models/Post.php");

	$post = new Post();
	
	$post->id = isset($_GET["id"]) ? $_GET["id"] : die();

	$result = $post->read_single();

	$post_array = array(
		"id" => $post->id, 
		"title" => $post->title, 
		"body" => $post->body, 
		"author" => $post->author, 
		"category_id" => $post->category_id, 
		"category_name" => $post->category_name
	);

	// print_r(json_encode($post_array));
	echo json_encode($post_array);

?>
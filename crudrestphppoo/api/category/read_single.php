<?php

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	header("Access-Control-Allow-Methods: GET");

	include_once("../../models/Category.php");

	$post = new Category();
	
	$post->id = isset($_GET["id"]) ? $_GET["id"] : die();

	$result = $post->read_single();

	$post_array = array(
		"id" => $post->id, 
		"name" => $post->name
	);

	// print_r(json_encode($post_array));
	echo json_encode($post_array);

?>
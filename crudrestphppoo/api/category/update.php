<?php 

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	header("Access-Control-Allow-Methods: PUT");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

	include_once("../../models/Category.php");

	$post = new Category();

	$data = json_decode(file_get_contents("php://input"));

	$post->id = $data->id;
	$post->name = $data->name;

	if($post->update()) {
		$response_array = array("message" => "Category updated.");
		echo json_encode($response_array);

	} else {
		$response_array = array("message" => "Category not updated.");
		echo json_encode($response_array);

	}

?>
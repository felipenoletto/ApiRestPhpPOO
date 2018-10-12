<?php 

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

	include_once("../../models/Category.php");

	$post = new Category();

	$data = json_decode(file_get_contents("php://input"));

	$post->name = $data->name;

	if($post->create()) {
		$response_array = array("message" => "Category created.");
		echo json_encode($response_array);

	} else {
		$response_array = array("message" => "Category not created.");
		echo json_encode($response_array);

	}

?>
<?php

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	header("Access-Control-Allow-Methods: GET");

	include_once("../../models/Category.php");

	$post = new Category();

	$result = $post->read();
	$num = $result->rowCount();

	if($num > 0) {
		$post_array = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$post_array[] = $row;

		}

		echo json_encode($post_array);

	} else {
		echo json_encode(array('message' => 'No Category Found'));

	}

?>
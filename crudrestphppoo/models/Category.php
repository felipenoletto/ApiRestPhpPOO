<?php

	include_once("../../config/config.php");

	class Category {

		public $id;
		public $name;

		// GET CATEGORIES
		public function read() {

			$sql = "SELECT id, name FROM categories ORDER BY id";
			$stmt = DB::prepare($sql);
			$stmt->execute();

			return $stmt;

		}

		// GET ONLY CATEGORY
		public function read_single() {

			$sql = "SELECT id, name FROM categories WHERE id = :id";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$this->id = $row['id'];
			$this->name = $row['name'];

		}

		// CREATE CATEGORY
		public function create() {
			$sql = "INSERT INTO categories(name) VALUES(:name)";
			$stmt = DB::prepare($sql);

			$this->name = htmlspecialchars(strip_tags($this->name));

			$stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
			
			if($stmt->execute()) {
				return true;

			}

			printf("Error: %s.\n", $stmt->error);

			return false;

		}

		// UPDATE CATEGORY
		public function update() {
			$sql = "UPDATE categories SET name = :name WHERE id = :id";
			$stmt = DB::prepare($sql);

			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
			$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
			
			if($stmt->execute()) {
				return true;

			}

			printf("Error: %s.\n", $stmt->error);

			return false;

		}

		// DELETE CATEGORY
		public function delete() {
			$sql = "DELETE FROM categories WHERE id = :id";
			$stmt = DB::prepare($sql);

			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
			
			if($stmt->execute()) {
				return true;

			}

			printf("Error: %s.\n", $stmt->error);

			return false;

		}

	}

?>
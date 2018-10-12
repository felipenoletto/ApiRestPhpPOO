<?php

	include_once("../../config/config.php");

	class Post {

		public $id;
		public $category_id;
		public $title;
		public $body;
		public $author;

		// GET ALL POSTS
		public function read() {
			$sql = "SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author 
			FROM posts p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id";

			$stmt = DB::prepare($sql);
			$stmt->execute();

			return $stmt;

		}

		// GET ONLY ONE POST
		public function read_single() {
			$sql = "SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author 
			FROM posts p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = :id";

			$stmt = DB::prepare($sql);
			$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$this->title = $row['title'];
			$this->body = $row['body'];
			$this->author = $row['author']; 
			$this->category_id = $row['category_id'];
			$this->category_name = $row['category_name'];

		}

		// CREATE POST
		public function create() {
			$sql = "INSERT INTO posts(title, body, author, category_id) VALUES(:title, :body, :author, :category_id)";
			$stmt = DB::prepare($sql);

			$this->title = htmlspecialchars(strip_tags($this->title));
			$this->body = htmlspecialchars(strip_tags($this->body));
			$this->author = htmlspecialchars(strip_tags($this->author));
			$this->category_id = htmlspecialchars(strip_tags($this->category_id));

			$stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
			$stmt->bindParam(":body", $this->body, PDO::PARAM_STR);
			$stmt->bindParam(":author", $this->author, PDO::PARAM_STR);
			$stmt->bindParam(":category_id", $this->category_id, PDO::PARAM_INT);
			
			if($stmt->execute()) {
				return true;

			}

			printf("Error: %s.\n", $stmt->error);

			return false;

		}

		// UPDATE POST
		public function update() {
			$sql = "UPDATE posts SET title = :title, body = :body, author = :author, category_id = :category_id WHERE id = :id";
			$stmt = DB::prepare($sql);

			$this->title = htmlspecialchars(strip_tags($this->title));
			$this->body = htmlspecialchars(strip_tags($this->body));
			$this->author = htmlspecialchars(strip_tags($this->author));
			$this->category_id = htmlspecialchars(strip_tags($this->category_id));
			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
			$stmt->bindParam(":body", $this->body, PDO::PARAM_STR);
			$stmt->bindParam(":author", $this->author, PDO::PARAM_STR);
			$stmt->bindParam(":category_id", $this->category_id, PDO::PARAM_INT);
			$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
			
			if($stmt->execute()) {
				return true;

			}

			printf("Error: %s.\n", $stmt->error);

			return false;

		}

		// DELETE POST
		public function delete() {
			$sql = "DELETE FROM posts WHERE id = :id";
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
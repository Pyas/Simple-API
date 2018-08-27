<?php
/**
 * 
 */

class Post
{ //db stuffs
	private static $conn,$table;
	public $id,$category_id,$category_name,$title,$body,$author,$created_at;
	function __construct(PDO $db)
	{
		self::$conn=$db;
		self::$table='posts';
		// $this->conn=$db;
		// $this->table='posts';
	}
	function read()
	{
		$query='SELECT 
		c.name as category_name,
		p.id,
		p.category_id,
		p.title,
		p.body,
		p.author,
		p.created_at
		FROM
		'.self::$table.'
		p LEFT JOIN categories c ON p.category_id=c.id
		ORDER BY
		p.created_at DESC';
		//prepare statement

		$stmt=self::$conn->prepare($query);
		//$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;

	}
	function single_post()
	{
		$query='SELECT 
		c.name as category_name,
		p.id,
		p.category_id,
		p.title,
		p.body,
		p.author,
		p.created_at
		FROM
		'.self::$table.'
		p LEFT JOIN categories c ON p.category_id=c.id
		WHERE
		p.id=:id
		LIMIT 0,1';
		//prepare statement

		//$stmt=$this->conn->prepare($query);
		$stmt=self::$conn->prepare($query);
		$stmt->bindParam(':id',$this->id,PDO::PARAM_STR);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		$this->category_name=$row['category_name'];
		$this->category_id=$row['category_id'];
		$this->title=$row['title'];
		$this->body=$row['body'];
		$this->author=$row['author'];
		$this->created_at=$row['created_at'];
		//print_r($row);

	}
	function setID($id)
	{
		$this->id=$id;
		return $this->id;
	}
}
<?php 
require 'functions.php';
// require 'router.php';

//  db connection
class database{

    public $connection;

     public function __construct()
    {
        $dsn = "mysql:host=localhost;dbname=myPHPapp;user=root;charset=utf8mb4;port=3306";
        $this->connection = new PDO($dsn);
    }

    public function query($query){
        $statement = $this->connection->prepare($query);
        
        $statement->execute();
        
        return $statement;
    }
   
}

$db = new database();
$posts = $db->query("SELECT * FROM posts")->fetchAll(PDO::FETCH_ASSOC);;

dd($posts);

// foreach($posts as $post){
//     echo "<li>" . $post['title'] . "</li>";
// }
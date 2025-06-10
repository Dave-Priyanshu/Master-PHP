<?php 
require 'functions.php';
// require 'router.php';
require 'Database.php';

$config = require 'config.php';
$db = new database($config);
$posts = $db->query("SELECT * FROM posts")->fetchAll(PDO::FETCH_ASSOC);

dd($posts);

// foreach($posts as $post){
//     echo "<li>" . $post['title'] . "</li>";
// }
<?php
$conn = mysqli_connect('localhost', 'root', 'root', 'sqlTest') or die("Connection Failed");

$sql = "SELECT * FROM persoanl";

$result = mysqli_query($conn, $sql) or die("Query Failed");

$output = mysqli_fetch_all($result,MYSQLI_ASSOC);


echo json_encode($output);
// echo "<pre>";
// print_r($output);
// echo "</pre>";

?>
<?php
session_start();

// ! to immediatly see how many sessions are set on the server
// print_r($_SESSION); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_SESSION['username']) && isset($_SESSION['favcolor'])){
        echo "session is set.<br>";
        echo $_SESSION['username']."'s fav color is ". $_SESSION['favcolor'];
    }
    else{
        echo "session is not set";
    }
    ?>
</body>
</html>
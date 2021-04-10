<?php
    // Heroku connection
    $dsn = 'mysql:host=cis9cbtgerlk68wl.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=w15yvbkbet0eioj3';
    $username = 'h12syis308ft7sz2';
    $password = 'uuvupbehd1y3fab2'; 
    
    try {
        // Heroku connection
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error = "Database Error: ";
        $error .= $e->getMessage();
        include('../view/error.php');
        exit();
    }
?>
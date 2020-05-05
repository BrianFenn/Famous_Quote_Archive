<?php
    $dsn = 'mysql:host=wm63be5w8m7gs25a.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=famous_quotes_site';
    $username = 'uhb1kcuh91da3z01';
    $password = 'v9w6fen1mwn1rlwv';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>

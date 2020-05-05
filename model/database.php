<?php
    $dsn = 'mysql:host=localhost;dbname=famous_quotes_site';
    $username = 'root';
    $password = 'Kholmes1#';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>
<?php
    $dsn = 'mysql:host=localhost;dbname=todolist';
    $username = 'root';
    
    try {
        $db = new PDO($dsn, $username);
    } catch (PDOException $e) {
        $db_error_msg = $e->getMessage();
        include('../view/error.php');
        exit();
    }

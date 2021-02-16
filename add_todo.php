<?php

require_once('db_connect.php');

$new_todo_title = filter_input(INPUT_POST, 'new_todo_title');
$new_todo_description = filter_input(INPUT_POST, 'new_todo_description');

$insertTodoQuery = 'INSERT INTO todoitems (title, description)
                VALUES (:new_todo_title, :new_todo_description)';     
$insertTodoStatement = $db->prepare($insertTodoQuery);
$insertTodoStatement->bindValue(':new_todo_title', $new_todo_title);
$insertTodoStatement->bindValue(':new_todo_description', $new_todo_description);
$insertTodoStatement->execute();
$insertTodoStatement->closeCursor();

unset($_POST);
header( "Location: index.php", true, 303 );
exit();

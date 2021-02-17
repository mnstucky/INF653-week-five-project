<?php

require_once('db_connect.php');

$new_todo_title = filter_input(INPUT_POST, 'new_todo_title');
$new_todo_description = filter_input(INPUT_POST, 'new_todo_description');
$new_todo_categoryId = filter_input(INPUT_POST, 'new_todo_categoryId', FILTER_VALIDATE_INT);

$insertTodoQuery = 'INSERT INTO todoitems (title, description, categoryid)
                VALUES (:new_todo_title, :new_todo_description, :new_todo_categoryId)';     
$insertTodoStatement = $db->prepare($insertTodoQuery);
$insertTodoStatement->bindValue(':new_todo_title', $new_todo_title);
$insertTodoStatement->bindValue(':new_todo_description', $new_todo_description);
$insertTodoStatement->bindValue(':new_todo_categoryId', $new_todo_categoryId);
$insertTodoStatement->execute();
$insertTodoStatement->closeCursor();

unset($_POST);
header( "Location: index.php", true, 303 );
exit();

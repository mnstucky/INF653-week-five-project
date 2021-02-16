<?php

require_once('db_connect.php');

$delete_todo_itemnum = filter_input(INPUT_POST, 'todo_itemnum');

$deleteTodoQuery = 'DELETE FROM todoitems
                WHERE itemnum = :delete_todo_itemnum';     
$deleteTodoStatement = $db->prepare($deleteTodoQuery);
$deleteTodoStatement->bindValue(':delete_todo_itemnum', $delete_todo_itemnum);
$deleteTodoStatement->execute();
$deleteTodoStatement->closeCursor();

unset($_POST);
header( "Location: index.php", true, 303 );
exit();

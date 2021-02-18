<?php

require('./model/item_db.php');

$new_todo_title = filter_input(INPUT_POST, 'new_todo_title');
$new_todo_description = filter_input(INPUT_POST, 'new_todo_description');
$new_todo_categoryId = filter_input(INPUT_POST, 'new_todo_categoryId', FILTER_VALIDATE_INT);

add_todo($new_todo_title, $new_todo_description, $new_todo_categoryId);

unset($_POST);
header( "Location: index.php", true, 303 );
exit();

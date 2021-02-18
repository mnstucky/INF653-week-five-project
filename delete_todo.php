<?php

require('./model/item_db.php');

$delete_todo_itemnum = filter_input(INPUT_POST, 'todo_itemnum');

delete_todo($delete_todo_itemnum);

unset($_POST);
header( "Location: index.php", true, 303 );
exit();

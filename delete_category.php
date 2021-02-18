<?php

require('./model/category_db.php');

$category_id_to_delete = filter_input(INPUT_POST, 'category_id_to_delete');
delete_category($category_id_to_delete);

unset($_POST);
header( "Location: edit_categories.php", true, 303 );
exit();

<?php

include('./model/category_db.php');

$new_category_name = filter_input(INPUT_POST, 'new_category_name');
add_category($new_category_name);

unset($_POST);
header( "Location: edit_categories.php", true, 303 );
exit();

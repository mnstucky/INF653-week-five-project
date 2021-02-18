<?php

require_once('db_connect.php');

$new_category_name = filter_input(INPUT_POST, 'new_category_name');

$insertCategoryQuery = 'INSERT INTO categories (categoryName)
                VALUES (:new_category_name)';     
$insertCategoryStatement = $db->prepare($insertCategoryQuery);
$insertCategoryStatement->bindValue(':new_category_name', $new_category_name);
$insertCategoryStatement->execute();
$insertCategoryStatement->closeCursor();

unset($_POST);
header( "Location: edit_categories.php", true, 303 );
exit();

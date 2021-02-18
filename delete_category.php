<?php

require_once('db_connect.php');

$category_id_to_delete = filter_input(INPUT_POST, 'category_id_to_delete');

$deleteCategoryQuery = 'DELETE FROM categories
                WHERE categoryId = :category_id_to_delete';     
$deleteCategoryStatement = $db->prepare($deleteCategoryQuery);
$deleteCategoryStatement->bindValue(':category_id_to_delete', $category_id_to_delete);
$deleteCategoryStatement->execute();
$deleteCategoryStatement->closeCursor();

unset($_POST);
header( "Location: edit_categories.php", true, 303 );
exit();

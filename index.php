<?php
require_once('db_connect.php');

if (!isset($categoryId)) {
    $categoryId = filter_input(
        INPUT_GET,
        'categoryId',
        FILTER_VALIDATE_INT
    );
}

if ($categoryId == NULL || $categoryId == FALSE) {
    $queryAllTodos = 'SELECT * FROM todoitems ORDER BY itemnum';
    $getTodosStatement = $db->prepare($queryAllTodos);
    $getTodosStatement->execute();
    $todos = $getTodosStatement->fetchAll();
    $getTodosStatement->closeCursor();
} else {
    $querySelectTodos = 'SELECT * FROM todoitems WHERE categoryID = :categoryId ORDER BY itemnum';
    $getTodosStatement = $db->prepare($querySelectTodos);
    $getTodosStatement->bindValue(':categoryId', $categoryId);
    $getTodosStatement->execute();
    $todos = $getTodosStatement->fetchAll();
    $getTodosStatement->closeCursor();
}

$queryAllCategories = 'SELECT * FROM categories ORDER BY categoryID';
$getCategoriesStatement = $db->prepare($queryAllCategories);
$getCategoriesStatement->execute();
$allCategories = $getCategoriesStatement->fetchAll();
$getCategoriesStatement->closeCursor();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <style type="text/css">
        body {
            font-family: "Noto Sans", sans-serif;
        }
    </style>
    <title>Week 5: ToDo List with Categories</title>
</head>

<body>
    <header class="container">
        <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h1>Todo List</h1>
                </a>
            </div>
        </nav>
    </header>
    <main class="container">
        <section class="mt-2 mb-2">
            <form action="index.php" method="GET">
                <label for="categoryId">
                    <h4>Category:</h4>
                </label>
                <select id="categoryId" name="categoryId">
                    <option value="all">View All Categories</option>
                    <?php foreach ($allCategories as $category) { ?>
                        <option value="<?php echo $category['categoryID'] ?>">
                            <?php echo $category['categoryName'] ?>
                        </option>
                    <?php } ?>
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
        </section>
        </form>
        <section>
            <?php if (empty($todos)) { ?>
                <p>Sorry. No todo list items exist yet.</p>
            <?php } else { ?>
                <div class="row ms-2 me-2 mb-0">
                    <div class="col d-flex justify-content-start">
                        <p class="mb-1">Title &nbsp;</p>
                        <p class="text-muted mb-1">Description</p>
                    </div>
                    <div class="col-3">
                        <p class="mb-1">Category</p>
                    </div>
                </div>
                <ul class="list-group">
                    <?php foreach ($todos as $todo) {
                        $thisCategoryId = $todo['categoryID'];
                        $queryCategoryName = 'SELECT categoryName FROM categories WHERE categoryID = :categoryId';
                        $getCategoryNameStatement = $db->prepare($queryCategoryName);
                        $getCategoryNameStatement->bindValue(':categoryId', $thisCategoryId);
                        $getCategoryNameStatement->execute();
                        $thisCategoryNameArray = $getCategoryNameStatement->fetch();
                        if ($thisCategoryNameArray === FALSE || $thisCategoryNameArray === NULL) {
                            $thisCategoryName = '';
                        } else {
                            $thisCategoryName = $thisCategoryNameArray['categoryName'];
                        }
                    ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col d-flex justify-content-start align-items-center">
                                    <h6 class="me-2 mb-0"><?php echo $todo['Title'] ?></h6>
                                    <p class="mb-0 text-muted"><?php echo $todo['Description'] ?></p>
                                </div>
                                <div class="col-3 d-flex justify-content-between align-items-center">

                                    <p class="mb-0"><?php echo $thisCategoryName; ?></p>
                                    <form action="delete_todo.php" method="POST">
                                        <input type="hidden" name="todo_itemnum" value="<?php echo $todo['ItemNum']; ?>">
                                        <button class="btn-close" aria-label="Delete"></button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </section>
        <section>
            <h4 class="mt-2">Add Item</h4>
            <form action="add_todo.php" method="POST">
                <label for="new_todo_categoryId">
                    Category:
                </label>
                <select id="new_todo_categoryId" name="new_todo_categoryId">
                    <?php foreach ($allCategories as $category) { ?>
                        <option value="<?php echo $category['categoryID'] ?>">
                            <?php echo $category['categoryName'] ?>
                        </option>
                    <?php } ?>
                </select>
                <input class="form-control m-1" type="text" name="new_todo_title" placeholder="Title">
                <input class="form-control m-1" type="text" name="new_todo_description" placeholder="Description">
                <button class="btn btn-primary m-1">Add Item</button>
            </form>
            <a href="edit_categories.php">View/Edit Categories</a>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
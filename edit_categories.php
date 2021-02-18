<?php
require_once('db_connect.php');

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
        <section>
            <h4 class="mt-1 mb-1">Category List</h4>
            <ul class="list-group">
                <?php foreach ($allCategories as $category) { ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col d-flex justify-content-start align-items-center">
                                <h6 class="me-2 mb-0"><?php echo $category['categoryName'] ?></h6>
                            </div>
                            <div class="col-3 d-flex flex-row-reverse align-items-center">
                                <form action="delete_category.php" method="POST">
                                    <input type="hidden" name="category_id_to_delete" value="<?php echo $category['categoryID']; ?>">
                                    <button class="btn-close" aria-label="Delete"></button>
                                </form>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </section>
        <section>
            <h4 class="mt-1 mb-1">Add Category</h4>
            <form class="row" action="add_category.php" method="POST">
                <div class="col-auto d-flex align-items-center">
                    <label for="new_category_name">
                        Name:
                    </label>
                </div>
                <div class="col-auto">
                    <input class="form-control m-1" type="text" name="new_category_name" placeholder="Category Name">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary m-1">Add Category</button>
                </div>


            </form>
        </section>
        <a href="index.php">View/Edit Todo List</a>
    </main>

</body>

</html>
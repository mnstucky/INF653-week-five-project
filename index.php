<?php
require_once('db_connect.php');
$queryAllTodos = 'SELECT * FROM todoitems ORDER BY itemnum';
$getTodosStatement = $db->prepare($queryAllTodos);
$getTodosStatement->execute();
$allTodos = $getTodosStatement->fetchAll();
$getTodosStatement->closeCursor();
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
    <title>Week 4: ToDo List</title>
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
            <?php if (empty($allTodos)) { ?>

                <p>Sorry. No todo list items exist yet.</p>
            <?php } else { ?>
                <ul class="list-group">
                    <?php foreach ($allTodos as $todo) { ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col d-flex justify-content-start align-items-center">
                                    <h6 class="me-2 mb-0"><?php echo $todo['Title'] ?></h6>
                                    <p class="mb-0 text-muted"><?php echo $todo['Description'] ?></p>
                                </div>
                                <div class="col-3 d-flex flex-row-reverse">
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
                <input class="form-control m-1" type="text" name="new_todo_title" placeholder="Title">
                <input class="form-control m-1" type="text" name="new_todo_description" placeholder="Description">
                <button class="btn btn-primary m-1">Add Item</button>
            </form>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
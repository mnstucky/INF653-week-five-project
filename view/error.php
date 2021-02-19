<?php require('./header.php'); ?>

<main>
    <h1>Database Error:</h1>
    <p>Sorry. There was an error connecting to the database.</p>
    <p>Error message: <?php echo $db_error_msg; ?></p>
</main>


<?php require('./footer.php'); ?>
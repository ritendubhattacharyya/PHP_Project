<?php
    include("individuals_connection.php");
    session_start();
    if(isset($_POST['updateBook'])) {
        $bookId = $_POST['updateBook'];
        $tableName = $_SESSION['username'].'books';
        // updateDetails
        $bookName = $_POST['bookName'];
        $authorName = $_POST['authorName'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        //update
        $sql = "UPDATE $tableName SET book_name=?, author_name=?, category=?, quantity=? WHERE id=$bookId";
        $stmt = mysqli_stmt_init($conn_individuals);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../updateBook.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 'sssi', $bookName, $authorName, $category, $quantity);
            mysqli_stmt_execute($stmt);
            header("Location: ../viewBooks.php?success=update");
        }


    } else {
        echo 'Error!!!';
    }
<?php
    include("individuals_connection.php");
    session_start();

    if(isset($_POST['addBooksButton'])) {
        $bookName = $_POST['bookName'];
        $authorName = $_POST['authorName'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];

        $table_name = $_SESSION['username'].'books';

        if(empty($bookName) || empty($authorName) || empty($category) || empty($quantity)) {
            header("Location: ../home.php?error=emptyfield&addBooks=true");
            exit();
        } else {
            $sql = "INSERT INTO $table_name(book_name, author_name, category, quantity) VALUES(?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn_individuals);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../home.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, 'sssi', $bookName, $authorName, $category, $quantity);
                mysqli_stmt_execute($stmt);
                header("Location: ../home.php?success=added&addBooks=true");
            }
        }
    } else {
        header("Location: ../home.php");
        exit();
    }
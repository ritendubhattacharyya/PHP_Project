<?php

    include("individuals_connection.php");
    session_start();

    if(isset($_POST['deleteBooksButton'])) {
        $bookId = $_POST['deleteBooksButton'];
        $tableName = $_SESSION['username'].'books';
        $issueTable = $_SESSION['username'].'issue';
        //check for issue
        $checkIssue = "SELECT * from $issueTable WHERE book_id=?;";
        $checkIssueStmt = mysqli_stmt_init($conn_individuals);
        if(!mysqli_stmt_prepare($checkIssueStmt, $checkIssue)) {
            header("Location: ../viewBooks.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($checkIssueStmt, 'i', $bookId);
            mysqli_stmt_execute($checkIssueStmt);
            mysqli_stmt_store_result($checkIssueStmt);
            if(mysqli_stmt_num_rows($checkIssueStmt)>0) {
                header("Location: ../viewBooks.php?error=alreadyissuedbysomeone");
                exit();
            } else {
                //deleting book
                $sql = "DELETE FROM $tableName WHERE id=?";
                $stmt = mysqli_stmt_init($conn_individuals);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../viewBooks.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, 'i', $bookId);
                    mysqli_stmt_execute($stmt);

                    header("Location: ../viewBooks.php?delete=success");
                }
            }
        }       
    } else {
        echo "error";
    }
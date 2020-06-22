<?php
    include("individuals_connection.php");
    session_start();
    if(isset($_POST['deleteIssuesButton'])) {
        $IDs = explode('|',$_POST['deleteIssuesButton']);
        $memberId = $IDs[0];
        $bookId = $IDs[1];
        $issueTable = $_SESSION['username'].'issue';
        $bookTable = $_SESSION['username'].'books';

        $deleteSql = "DELETE FROM $issueTable WHERE member_id=? AND book_id=?";
        $deleteStmt = mysqli_stmt_init($conn_individuals);
        if(!mysqli_stmt_prepare($deleteStmt, $deleteSql)) {
            header("Location: ../viewissues.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($deleteStmt, 'ii', $memberId, $bookId);
            mysqli_stmt_execute($deleteStmt);

            //increasing book quantity
            $quantitySql = "SELECT * FROM $bookTable WHERE id=?";
            $quantityStmt = mysqli_stmt_init($conn_individuals);
            if(!mysqli_stmt_prepare($quantityStmt, $quantitySql)) {
                header("Location: ../viewissues.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($quantityStmt, 'i', $bookId);
                mysqli_stmt_execute($quantityStmt);
                $result = mysqli_stmt_get_result($quantityStmt);
                $rowQuant = mysqli_fetch_assoc($result);
                $actualQuant = (int)$rowQuant['quantity'] + 1;

                $updateSql = "UPDATE $bookTable SET quantity=? WHERE id=?";
                $updateStmt = mysqli_stmt_init($conn_individuals);
                if(!mysqli_stmt_prepare($updateStmt, $updateSql)) {
                    header("Location: ../viewissues.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($updateStmt, 'ii', $actualQuant, $bookId);
                    mysqli_stmt_execute($updateStmt);

                    header("Location: ../viewissues.php?success=delete");
                }

            }
        }
    } else {
        echo Error;
    }
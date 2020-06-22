<?php

    include("individuals_connection.php");
    session_start();

    if(isset($_POST['deleteMemberButton'])) {
        $memberId = $_POST['deleteMemberButton'];
        $tableName = $_SESSION['username'].'member';
        $issueTable = $_SESSION['username'].'issue';
        //check for issue
        $checkIssue = "SELECT * from $issueTable WHERE member_id=?;";
        $checkIssueStmt = mysqli_stmt_init($conn_individuals);
        if(!mysqli_stmt_prepare($checkIssueStmt, $checkIssue)) {
            header("Location: ../viewMembers.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($checkIssueStmt, 'i', $memberId);
            mysqli_stmt_execute($checkIssueStmt);
            mysqli_stmt_store_result($checkIssueStmt);
            if(mysqli_stmt_num_rows($checkIssueStmt)>0) {
                header("Location: ../viewMembers.php?error=alreadyissuedabook");
                exit();
            } else {
                //deleting book
                $sql = "DELETE FROM $tableName WHERE id=?";
                $stmt = mysqli_stmt_init($conn_individuals);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../viewMembers.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, 'i', $memberId);
                    mysqli_stmt_execute($stmt);

                    header("Location: ../viewMembers.php?delete=success");
                }
            }
        }       
    } else {
        echo "error";
    }
<?php 
    include("include/individuals_connection.php");
    session_start();
    if(isset($_POST['renewBooksButton'])) {
        $IDs = explode('|', $_POST['renewBooksButton']);
        $memberId = $IDs[0];
        $bookId = $IDs[1];
        $issueTable = $_SESSION['username'].'issue';

        $todayDate = date('Y-m-d');
        $sql = "UPDATE $issueTable SET issue_date=? WHERE member_id=? AND book_id=?";
        $stmt = mysqli_stmt_init($conn_individuals);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: viewissues.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 'sii', $todayDate, $memberId, $bookId);
            mysqli_stmt_execute($stmt);
            header("Location: viewissues.php?success=renewed");
        }
    } else {
        echo 'error';
    }
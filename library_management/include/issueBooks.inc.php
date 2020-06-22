<?php
    include("individuals_connection.php");
    session_start();

    if(isset($_POST['issueBooksButton'])) {
        $memberId = $_POST['memberId'];
        $bookId = $_POST['bookId'];
        $issueDate = $_POST['issueDate'];

        $table_name = $_SESSION['username'].'issue';

        $membertable = $_SESSION['username'].'member';
        $bookstable = $_SESSION['username'].'books';

        if(empty($memberId) || empty($bookId) || empty($issueDate)) {
            header("Location: ../home.php?error=emptyfield&issueBooks=true");
            exit();
        } else {
            $memberCheck = false;
            $booksCheck = false;
            $duplicateIssue = false;
            //member id check
            $findmemberid = "SELECT * FROM $membertable";
            $memberresult = mysqli_query($conn_individuals, $findmemberid);
            if(mysqli_num_rows($memberresult) > 0) {
                if((int)$memberId) {
                    while($row=mysqli_fetch_assoc($memberresult)) {
                        if((int)$row['id'] === (int)$memberId) {
                            $memberCheck = true;
                            break;
                        }
                    }
                } else {
                    echo 'error';
                } 
            } else {
                header("Location: ../home.php?error=nomembers&issueBooks=true");
                exit();
            }

            //book id check
            $findbooksid = "SELECT * FROM $bookstable";
            $booksresult = mysqli_query($conn_individuals, $findbooksid);
            if(mysqli_num_rows($booksresult) > 0) {
                if((int)$bookId) {
                    while($row=mysqli_fetch_assoc($booksresult)) {
                        if((int)$row['id'] === (int)$bookId) {
                            $booksCheck = true;
                            if((int)$row['quantity'] > 0) {
                                $value = (int)$row['quantity'] - 1;
                                $updateQuantity = "UPDATE $bookstable SET quantity=? WHERE id=?";
                                $updatestmt = mysqli_stmt_init($conn_individuals);
                                if(!mysqli_stmt_prepare($updatestmt, $updateQuantity)) {
                                    header("Location: ../home.php?error=sqlerror");
                                    exit();
                                } else {
                                    mysqli_stmt_bind_param($updatestmt, 'ii', $value, $bookId);
                                    mysqli_stmt_execute($updatestmt);
                                }
                                break;
                            } else {
                                $booksCheck = false;
                            }
                        }
                    }
                } else {
                    echo 'error';
                } 
            } else {
                header("Location: ../home.php?error=nobooks&issueBooks=true");
                exit();
            }

            //duplicate issue check
            $sqlcheckduplicate = "SELECT * FROM $table_name";
            $duplicateIssueResult = mysqli_query($conn_individuals, $sqlcheckduplicate);
            if(mysqli_num_rows($duplicateIssueResult) > 0) {
                if((int)$bookId && (int)$memberId) {
                    while($row=mysqli_fetch_assoc($duplicateIssueResult)) {
                        if((int)$row['book_id'] === (int)$bookId && (int)$row['member_id'] === (int)$memberId) {
                            $duplicateIssue = true;
                            break;
                        }
                    }
                } else {
                    echo 'error';
                } 
            }

            //issue books
            if($memberCheck === true && $booksCheck === true && $duplicateIssue === false) {
                $sql = "INSERT INTO $table_name(member_id, book_id, issue_date) VALUES(?, ?, ?)";
                $stmt = mysqli_stmt_init($conn_individuals);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../home.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, 'iis', $memberId, $bookId, $issueDate);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../home.php?success=added&issueBooks=true");
                }
            } else {
                header("Location: ../home.php?error=bookidormemberidnotexistoralreadyissued&issueBooks=true");
                exit();
            }

        }
    } else {
        header("Location: ../home.php");
        exit();
    }
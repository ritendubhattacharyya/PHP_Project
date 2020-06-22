<?php 
    include("include/individuals_connection.php");
    session_start();    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/styles.css?v=<?php echo time(); ?>">
        <title>Library</title>
    </head>
    <body>
        <?php
            if(isset($_POST["updateBooksButton"])) {
                $table_name = $_SESSION['username'].'books';
                $bookId = $_POST["updateBooksButton"];
                $details = "SELECT * FROM $table_name WHERE id=?";
                $detailsStmt = mysqli_stmt_init($conn_individuals);
                if(!mysqli_stmt_prepare($detailsStmt, $details)) {
                    header("Location: ../viewBooks.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($detailsStmt, 'i', $bookId);
                    mysqli_stmt_execute($detailsStmt);
                    $result = mysqli_stmt_get_result($detailsStmt);
                    $row = mysqli_fetch_assoc($result);
                    echo '
                    <div class="addBooksContainer" style="background-color: #d1d1d1">
                        <form action="include/updateBookDb.inc.php" method="post" class="addBooksForm">
                            <input type="text" name="bookName" value="'.$row['book_name'].'"/>
                            <input type="text" name="authorName" value="'.$row['author_name'].'"/>
                            <input type="text" name="category" value="'.$row['category'].'"/>
                            <input type="number" name="quantity" value="'.$row['quantity'].'"/>
                            <button type="submit" name="updateBook" class="add" style="background-color: green" value="'.$bookId.'">UPDATE</button>
                            <a href="viewBooks.php" class="close">CANCEL</a>
                        </form>
                    </div>';
                }

            } else {
                echo '
                    <div class="addBooksContainer" style="background-color: #d1d1d1">
                        ERROR!!!
                    </div>';;
            }
        ?>
        
    </body>
</html>
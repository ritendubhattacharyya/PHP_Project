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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css?v=<?php echo time(); ?>" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <title>Library</title>
    </head>
    <body class="bg-secondary">
        <!-- view books -->
        <div class="container-fluid">
            <div class="back text-center">
                <a href="home.php" class="btn btn-warning mx-10 my-3 px-5">BACK</a>
            </div>
            <table class="table table-striped bg-light">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Author Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $username = $_SESSION["username"];
                        $sql = "SELECT * FROM ".$_SESSION["username"]."books";
                        $result = mysqli_query($conn_individuals, $sql);
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<th scope=\"row\">".$row["id"]."</th>";  
                                echo "<td>".$row["book_name"]."</td>";  
                                echo "<td>".$row["author_name"]."</td>";  
                                echo "<td>".$row["category"]."</td>";  
                                echo "<td>".$row["quantity"]."</td>";  
                                echo "<td><form action=\"include/deleteBooks.inc.php\" method=\"post\" style=\"display: inline-block\"><button type=\"submit\" class=\"btn btn-danger mx-auto\" name=\"deleteBooksButton\" value=".$row["id"].">DELETE</button></form>
                                          <form action=\"updateBook.php\" method=\"post\" style=\"display: inline-block\"><button type=\"submit\" class=\"btn btn-success mx-auto\" name=\"updateBooksButton\" value=".$row["id"].">UPDATE</button></form></td>";  
                                echo "</tr>";  
                            }
                        } else {
                            echo "sorry!!! error";
                        }
                    ?>
                </tbody>
            </table>
        </div>

    </body>
</html>
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
                        <th scope="col">memberId</th>
                        <th scope="col">bookId</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Issue Date</th>
                        <th scope="col">DaysAfterIssue</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $username = $_SESSION["username"];
                        $issueTable = $_SESSION["username"]."issue";
                        $booksTable = $_SESSION["username"]."books";
                        $sql = "SELECT * FROM $issueTable LEFT JOIN $booksTable ON $issueTable.book_id = $booksTable.id";
                        $result = mysqli_query($conn_individuals, $sql);
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {

                                //days Calculation
                                $prevDate = strtotime($row["issue_date"]);
                                $todaysDate = strtotime(date("Y-m-d"));
                                $diff = $todaysDate - $prevDate;
                                $numberOfDays = floor($diff/(60*60*24));

                                //display table
                                echo "<tr>";
                                echo "<td>".$row["member_id"]."</th>";  
                                echo "<td>".$row["book_id"]."</td>";  
                                echo "<td>".$row["book_name"]."</td>";  
                                echo "<td>".$row["issue_date"]."</td>";  
                                echo "<td>".$numberOfDays."</td>";   
                                echo "<td><form action=\"include/deleteIssues.inc.php\" method=\"post\" style=\"display: inline-block\"><button type=\"submit\" class=\"btn btn-danger mx-auto\" name=\"deleteIssuesButton\" value=".$row["member_id"]."|".$row["book_id"].">DELETE</button></form>
                                          <form action=\"renewBook.php\" method=\"post\" style=\"display: inline-block\"><button type=\"submit\" class=\"btn btn-success mx-auto\" name=\"renewBooksButton\" value=".$row["member_id"]."|".$row["book_id"].">RENEW</button></form></td>";  
                                echo "</tr>";  
                            }
                        } 
                    ?>
                </tbody>
            </table>
        </div>

    </body>
</html>
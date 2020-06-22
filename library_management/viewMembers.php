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
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Adhaar</th>
                        <th scope="col">Address</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $username = $_SESSION["username"];
                        $sql = "SELECT * FROM ".$_SESSION["username"]."member";
                        $result = mysqli_query($conn_individuals, $sql);
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<th scope=\"row\">".$row["id"]."</th>";  
                                echo "<td>".$row["firstname"]."</td>";  
                                echo "<td>".$row["lastname"]."</td>";  
                                echo "<td>".$row["dob"]."</td>";  
                                echo "<td>".$row["adhaar"]."</td>";  
                                echo "<td>".$row["address"]."</td>";  
                                echo "<td>".$row["mobile"]."</td>";  
                                echo "<td><form action=\"include/deleteMember.inc.php\" method=\"post\"><button type=\"submit\" class=\"btn btn-danger mx-auto\" name=\"deleteMemberButton\" value=".$row["id"].">DELETE</button></form></td>";  
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
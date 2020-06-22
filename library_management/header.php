<?php session_start() ?>
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
    <header>
        <div class="logo">
            <img src="img/logo.jpg" alt="logo"/>
            <h3>LBM SYSTEM</h3>
        </div>

        <?php
            if(isset($_SESSION['username'])) {
                echo '
                    <div class="logout-wrapper">
                        <p>Welcome '.$_SESSION['username'].'</p>
                        <form action="include/logout.inc.php" method="post" class="logout">
                            <button type="submit" name="logout">LOGOUT</button>
                        </form>
                    </div>
                    <div class="hamburger">';
                        if(isset($_GET['success']) || isset($_GET['error'])) {
                            echo '<div class="line1 line1Mod"></div>';
                            echo '<div class="line2 line2Mod"></div>';
                            echo '<div class="line3 line3Mod"></div>';
                        } else {
                            echo '<div class="line1"></div>';
                            echo '<div class="line2"></div>';
                            echo '<div class="line3"></div>';
                        }
                echo '</div>';
            } else {
                echo '
                <form action="include/login.inc.php" method="post" class="login">
                    <input type="text" placeholder="USERNAME" name="uid"/>
                    <input type="password" placeholder="PASSWORD" name="pwd"/>
                    <button type="submit" name="login">LOGIN</button>
                </form>';
            }
        ?>

        

        <!-- When user logged out -->
        
        <!-- When user logged in -->
        
    </header>
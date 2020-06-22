<?php include("header.php") ?>
    <main>
        <div class="signup-form">
            <h3>SIGN UP</h3>
            <?php
                if(isset($_GET['error'])) {
                    if($_GET['error'] === 'emptyfield') {
                        echo '<div class="error">
                        <img src="img/error.png" alt="E:">
                        <p class="error">Fields should not empty</p>
                        </div>';
                    } else if($_GET['error'] === 'invalidemail') {
                        echo '<div class="error">
                        <img src="img/error.png" alt="E:">
                        <p class="error">Invalid email</p>
                        </div>';
                    } else if($_GET['error'] === 'passwordlength') {
                        echo '<div class="error">
                        <img src="img/error.png" alt="E:">
                        <p class="error">Password should be between 8 to 24 charector</p>
                        </div>';
                    } else if($_GET['error'] === 'passwordrequirment') {
                        echo '<div class="error">
                        <img src="img/error.png" alt="E:">
                        <p class="error">Password should not contain the special charector</p>
                        </div>';
                    } else if($_GET['error'] === 'passwordnotmatch') {
                        echo '<div class="error">
                        <img src="img/error.png" alt="E:">
                        <p class="error">Password did not match</p>
                        </div>';
                    } else if($_GET['error'] === 'uidalreadyexists') {
                        echo '<div class="error">
                        <img src="img/error.png" alt="E:">
                        <p class="error">Username already exists</p>
                        </div>';
                    }
                } else if(isset($_GET['signup'])) {
                    echo '<div class="success">
                    <img src="img/success.png" alt="E:">
                    <p class="error">Account created successfully</p>
                    </div>';
                }
            ?>
            <!-- <div class="error">
                <img src="img/error.png" alt="E:">
                <p class="error">Lorem ipsum dolor sit amet consectetur</p>
            </div>
            <div class="success">
                <img src="img/success.png" alt="E:">
                <p class="error">Lorem ipsum dolor sit amet consectetur</p>
            </div> -->
            <form action="include/signup.inc.php" method="post" class="signup">

                <?php
                    if(isset($_GET['uid'])) {
                        echo '<input type="text" name="uid" placeholder="USERNAME" value="'.$_GET['uid'].'">';
                    } else {
                        echo '<input type="text" name="uid" placeholder="USERNAME">';
                    }

                    if(isset($_GET['mail'])) {
                        echo '<input type="text" name="mail" placeholder="E-MAIL" value="'.$_GET['mail'].'">';
                    } else {
                        echo '<input type="text" name="mail" placeholder="E-MAIL">';
                    }

                    if(isset($_GET['library_name'])) {
                        echo '<input type="text" name="library_name" placeholder="LIBRARY NAME" value="'.$_GET['library_name'].'">';
                    } else {
                        echo '<input type="text" name="library_name" placeholder="LIBRARY NAME">';
                    }
                ?>
                <!-- <input type="text" name="uid" placeholder="USERNAME">
                <input type="text" name="mail" placeholder="E-MAIL">
                <input type="text" name="library_name" placeholder="LIBRARY NAME"> -->
                <input type="password" name="pwd" placeholder="PASSWORD">
                <input type="password" name="confirm_pwd" placeholder="CONFIRM PASSWORD">
                <input type="number" name="max_num_days" placeholder="MAX NUMBER OF DAYS FROM 1 RENEW">
                <button type="submit" name="signup">SIGN UP</button>
            </form>
        </div>    

    </main>
</body>
</html>
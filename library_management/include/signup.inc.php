<?php
    include("user_table_connection.php");
    include("individuals_connection.php");

    if(isset($_POST['signup'])) {
        $secured_uid = mysqli_real_escape_string($conn_individuals, $_POST['uid']);
        $uid = $_POST['uid'];
        $mail = $_POST['mail'];
        $library_name = $_POST['library_name'];
        $pwd = $_POST['pwd'];
        $confirm_pwd = $_POST['confirm_pwd'];
        $max_days = $_POST['max_num_days'];

        if(empty($uid) || empty($mail) || empty($library_name) || empty($pwd) || empty($confirm_pwd) || empty($max_days)) {
            header("Location: ../index.php?error=emptyfield&uid=".$uid."&mail=".$mail."&library_name=".$library_name);
            exit();
        } else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../index.php?error=invalidemail&uid=".$uid."&library_name=".$library_name);
            exit();
        } else if(strlen($pwd) < 8 || strlen($pwd) > 24) {
            header("Location: ../index.php?error=passwordlength&uid=".$uid."&mail=".$mail."&library_name=".$library_name);
            exit();
        } else if(!preg_match("/^[a-zA-Z0-9]*$/", $pwd)) {
            header("Location: ../index.php?error=passwordrequirment&uid=".$uid."&mail=".$mail."&library_name=".$library_name);
            exit();
        } else if($pwd !== $confirm_pwd) {
            header("Location: ../index.php?error=passwordnotmatch&uid=".$uid."&mail=".$mail."&library_name=".$library_name);
            exit();
        } else {
            $sql = "SELECT uid FROM users WHERE uid=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, 's', $uid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)>0) {
                    header("Location: ../index.php?error=uidalreadyexists&uid=".$uid."&mail=".$mail."&library_name=".$library_name);
                    exit();
                } else {
                    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users(uid, mail, library_name, pwd, max_num_days) VALUES(?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../index.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, 'ssssi', $uid, $mail, $library_name, $hashedpwd, $max_days);
                        mysqli_stmt_execute($stmt);

                        //creating tables for indivuduals
                        $sql_create_one = "CREATE TABLE ".$secured_uid."books (id INT PRIMARY KEY AUTO_INCREMENT, book_name VARCHAR(150), author_name VARCHAR(200), category VARCHAR(200), quantity INT)";
                        $sql_create_two = "CREATE TABLE ".$secured_uid."member (id INT PRIMARY KEY AUTO_INCREMENT, firstname VARCHAR(50), lastname VARCHAR(50), dob VARCHAR(30), adhaar VARCHAR(30), address VARCHAR(200), mobile INT(20))";
                        $sql_create_three = "CREATE TABLE ".$secured_uid."issue (member_id INT, book_id INT, issue_date VARCHAR(20), FOREIGN KEY (member_id) REFERENCES ".$secured_uid."member(id), FOREIGN KEY (book_id) REFERENCES ".$secured_uid."books(id))";
                        
                        mysqli_query($conn_individuals, $sql_create_one);
                        mysqli_query($conn_individuals, $sql_create_two);
                        mysqli_query($conn_individuals, $sql_create_three);

                        header("Location: ../index.php?signup=success");
                    }
                }
            }
        }
    } else {
        header("Location: ../index.php");
        exit();
    }
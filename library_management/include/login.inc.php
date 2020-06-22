<?php
include("user_table_connection.php");

if(isset($_POST['login'])) {
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $sql = "SELECT * FROM users WHERE uid=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
    } else {
        mysqli_stmt_bind_param($stmt, 's', $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)) {
            if(password_verify($pwd, $row['pwd'])) {
                session_start();
                $_SESSION['username'] = $uid;
                header("Location: ../home.php?login=success");
            } else {
                header("Location: ../index.php?error=wrongpwd");
            }
        } else {
            header("Location: ../index.php?error=notauser");
        }
    }
    
} else {
    header("Location: ../index.php");
}
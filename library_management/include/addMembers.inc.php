<?php
    include("individuals_connection.php");
    session_start();

    if(isset($_POST['addMembersButton'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $dob = $_POST['dob'];
        $adhaar = $_POST['adhaar'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];

        $table_name = $_SESSION['username'].'member';

        if(empty($firstname) || empty($lastname) || empty($dob) || empty($adhaar) || empty($address) || empty($mobile)) {
            header("Location: ../home.php?error=emptyfield&addMembers=true");
            exit();
        } else {
            $sql = "INSERT INTO $table_name(firstname, lastname, dob, adhaar, address, mobile) VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn_individuals);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../home.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, 'sssssi', $firstname, $lastname, $dob, $adhaar, $address, $mobile);
                mysqli_stmt_execute($stmt);
                header("Location: ../home.php?success=added&addMembers=true");
            }
        }
    } else {
        header("Location: ../home.php");
        exit();
    }
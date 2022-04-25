<?php 
    // signed in or not?
    include_once '../CheckSignedIn.php';
    if (!$signed_in) {
        mysqli_close($conn);
        header('Location: ../View/SignIn.php');
    }    

    // if signed in with remember
    if (isset($_COOKIE['username'])) {
        //delete cookie
        setcookie('username', '', time() - 60, '/','localhost');
        setcookie('token', '', time() - 60, '/','localhost');

        //delete token in DB
        $username = $_COOKIE['username'];
        $sql_token = "
            DELETE FROM token 
            WHERE username = '$username'
        ";
        $conn->query($sql_token);

        //delete session
        session_start();
        session_destroy();
    }

    // if signed in without remember
    else {
        session_start();
        session_destroy();
    }

    // move to SignIn.php
    mysqli_close($conn);
    header('Location: ../View/SignIn.php');
?>
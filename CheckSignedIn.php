<?php
    include_once 'Config.php';
    session_start();
    $signed_in = false;
    // case 1: cookie is existed
    if (isset($_COOKIE['username']) && isset($_COOKIE['token'])) {
        $username = $_COOKIE['username'];
        $token = $_COOKIE['token'];
        $sql_check_signed_in = "
            SELECT username, token
            FROM token 
            WHERE username='$username' AND token='$token'
        ";
        $sql_result_signed_in = $conn->query($sql_check_signed_in);

        if ($sql_result_signed_in) $signed_in = true;
    }

    // case 2: cookie is not existed, but session is existed
    else {
        if (isset($_SESSION['username'])) $signed_in = true;
    }
    
    // case 3: the rest -> $signed_in = false
    
?>
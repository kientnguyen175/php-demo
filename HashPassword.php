<?php
    $password = 'kiennt175';
    $hashed_password = password_hash($password,PASSWORD_DEFAULT);
    var_dump(password_verify($password, $hashed_password));
?>
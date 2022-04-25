<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'mini_php_prj_db';

    //connect to DB
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    
    //handle result from connecting
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
    
    $cookie_time = 3600 * 24 * 30; // 30 days
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    
    $wordtype = ['Danh từ', 'Động từ', 'Tính từ', 'Trạng từ', 'Đại từ', 'Hạn định từ', 'Giới từ', 'Liên từ'];
?>
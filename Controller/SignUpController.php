<?php
    // signed in or not?
    include_once '../CheckSignedIn.php';
    include_once '../HandleInput.php';
    if ($signed_in) {
        mysqli_close($conn);
        header('Location: ../View/Home.php');
    }    

    // prepare create_word statement
    $sql_sign_up = "
        INSERT INTO user (fullname, username, password) 
        VALUE (?, ?, ?)
    ";
    if($sign_up = $conn->prepare($sql_sign_up)){
        $sign_up->bind_param("sss", $fullname, $username, $password);
    } 
    else {
        echo "ERROR: Không thể chuẩn bị truy vấn: $sql_sign_up. " . $conn->error;
    }

    //prepare check_username statement
    $sql_check_username = "
        SELECT username 
        FROM user 
        WHERE username=?
    ";
    if($check_username = $conn->prepare($sql_check_username)){
        $check_username->bind_param("s", $username);
    } 
    else {
        echo "ERROR: Không thể chuẩn bị truy vấn: $sql_check_username. " . $conn->error;
    }

    //Get data from signup.php 
    $fullname = handle_input($_POST['fullname']);   
    $username = handle_input($_POST['username']);
    $password = handle_input($_POST['password']);
    $password = sha1($password);
    
    //data is full or not?
    if (!$fullname || !$username || !handle_input($_POST['password']))
    {
        echo "Vui lòng nhập đầy đủ thông tin! <br/>";
        echo  "<a href='javascript: history.go(-1)'> Quay lại trang đăng kí </a>";
        exit();
    }

    //username is existed or not?
    $check_username->execute();
    if (mysqli_num_rows($check_username->get_result()) > 0){ 
        // function mysqli_num_rows() return number of rows of result from selecting
        echo "Username đã tồn tại, vui lòng nhập lại <br/>";
        echo "<a href='javascript: history.go(-1)'> Quay lại trang đăng kí </a>";
        exit();
    }

    //insert data to DB
    $register = $sign_up->execute();
    mysqli_close($conn);
    if ($register) {
        echo "Đăng ký thành công <br/>";
        echo "<a href='../View/SignIn.php'> Đăng nhập </a>";
    }
    else {
        echo "Có lỗi xảy ra trong quá trình đăng ký <br/>";
        echo "<a href='javascript: history.go(-1)'> Thử lại </a>";
    }
?>
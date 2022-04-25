<?php 
    include_once '../GenerateRandomString.php';
    include_once '../HandleInput.php';
    
    // signed in or not?
    include_once '../CheckSignedIn.php';
    if ($signed_in) {
        mysqli_close($conn);
        header('Location: ../View/Home.php');
    }
    // prepare check_sign_in statement
    $sql_check_sign_in = "
        SELECT username, password 
        FROM user 
        WHERE username=? AND password=?
    ";
    if($check_sign_in = $conn->prepare($sql_check_sign_in)){
        $check_sign_in->bind_param("ss", $username, $password);
    } 
    else {
        echo "ERROR: Không thể chuẩn bị truy vấn: $sql_check_sign_in. " . $conn->error;
    }

    //Get data from Login.php  
    $username = handle_input($_POST['username']);
    $password = sha1(handle_input($_POST['password']));
    $remember = isset($_POST['remember']);
    
    // data is full or not?
    if (!$username || !handle_input($_POST['password'])) {
        echo "Đăng nhập thất bại, vui lòng điền đủ thông tin <br/>";
        echo "<a href='javascript: history.go(-1)'> Thử lại </a>";
        exit;
    }

    //check sign in
    $check_sign_in->execute();
    $result = $check_sign_in->get_result();
    
    //if sign in fail
    if (mysqli_num_rows($result) == 0) {
        echo "Tài khoản hoặc mật khẩu không đúng, vui lòng đăng nhập lại <br/>";
        echo "<a href='javascript: history.go(-1)'> Thử lại </a>";
        exit();
    }

    session_start();

    //if sign in success and click "remember me"
    if ($result && $remember) {
        // delete old token of the user (sign out auto when cookie die)
        $sql_token = "
            DELETE FROM token 
            WHERE username = '$username'
        ";
        $conn->query($sql_token);

        // setcookie and session
        setcookie('username', $username, time() + $cookie_time, '/','localhost');
        
        $token = rand_string(64);
        setcookie('token', $token, time() + $cookie_time, '/','localhost');
        $sql_set_token = "
            INSERT INTO token (username, token)
            VALUES ('$username', '$token')
        ";
        $conn->query($sql_set_token);

        $_SESSION['username'] = $username;
        mysqli_close($conn);
        header('Location: ../View/Home.php');
    }

    //if sign in success and don't click "remember me"
    if ($result && !$remember) {
        $_SESSION['username']=$username;
        mysqli_close($conn);
        header('Location: ../View/Home.php');
    }
?>
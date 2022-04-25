<?php 
    include_once '../HandleInput.php';

    // signed in or not?
    include_once '../CheckSignedIn.php';
    if (!$signed_in) {
        mysqli_close($conn);
        header('Location: ../View/SignIn.php');
    }
    // prepare create_word statement
    $sql_create_word = "
        INSERT INTO word (username, word, type, meaning, note) 
        VALUES (?, ?, ?, ?, ?)
    ";
    if($create_word = $conn->prepare($sql_create_word)){
        $create_word->bind_param("sssss", $username, $word, $type, $meaning, $note);
    } 
    else {
        echo "ERROR: Không thể chuẩn bị truy vấn: $sql_create_word. " . $conn->error;
    }

    // get data
    $word = handle_input($_POST['word']);
    if (isset($_POST['type'])) $type = $_POST['type'];
    $meaning = handle_input($_POST['meaning']);
    
    $note = handle_input($_POST['note']);
    $username = $_SESSION['username'];
    
    // check data
    if (!$word || !isset($type) || !$meaning) {
        echo "Vui lòng điền đủ thông tin <br/>";
        echo "<a href='javascript: history.go(-1)'> Thử lại </a>";
        exit;
    }

    // insert to DB
    $result = $create_word->execute();
    
    if ($result) {
        $_SESSION['create_word'] = 'Thêm từ thành công!';
        mysqli_close($conn);
        header('Location: ../View/Home.php');
    }
    else {
        echo "Có lỗi xảy ra <br/>";
        echo "<a href='javascript: history.go(-1)'> Thử lại </a>";
    }
?>
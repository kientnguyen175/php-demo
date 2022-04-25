<?php  
    include_once '../HandleInput.php';

    // signed in or not?
    include_once '../CheckSignedIn.php';
    if (!$signed_in) {
        mysqli_close($conn);
        header('Location: ../View/SignIn.php');
    }

    // prepare update_word statement
    $sql_update_word = "
        UPDATE word
        SET username=?, word=?, type=?, meaning=?, note=?
        WHERE word_id=?
    ";
    if($update_word = $conn->prepare($sql_update_word)){
        $update_word->bind_param("ssssss", $username, $word, $type, $meaning, $note, $word_id);
    } 
    else {
        echo "ERROR: Không thể chuẩn bị truy vấn: $sql_update_word. " . $conn->error;
    }

    // get data
    $username = $_SESSION['username'];
    $word_id = $_POST['word_id'];
    $word = handle_input($_POST['word']);
    if (isset($_POST['type'])) $type = $_POST['type'];
    $meaning = handle_input($_POST['meaning']);
    $note = handle_input($_POST['note']);

    // check data
    if (!$word || !isset($type) || !$meaning) {
        echo "Vui lòng điền đủ thông tin <br/>";
        echo "<a href='javascript: history.go(-1)'> Thử lại </a>";
        exit;
    }

    // update to DB
    if ($update_word->execute()) {
        mysqli_close($conn);
        $_SESSION['update_word'] = "Cập nhật từ thành công!";
        header('Location: ../View/Home.php');
    }
    else {
        echo "Có lỗi xảy ra <br/>";
        echo "<a href='javascript: history.go(-1)'> Thử lại </a>";
    }
?>
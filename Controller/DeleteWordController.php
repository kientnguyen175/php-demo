<?php
    // signed in or not?
    include_once '../CheckSignedIn.php';
    if (!$signed_in) { 
        mysqli_close($conn);
        header('Location: ../View/SignIn.php');
    }   

    // prepare delete_word statement
    $sql_delete_word = "
        DELETE FROM word
        WHERE word_id = ?
    ";
    if($delete_word = $conn->prepare($sql_delete_word)){
        $delete_word->bind_param("i", $word_id);
    } 
    else {
        echo "ERROR: Không thể chuẩn bị truy vấn: $sql_delete_word. " . $conn->error;
    }

    //get data
    $word_id = $_GET['word_id'];

    //delete the word
    $result = $delete_word->execute();
  
    if ($result) {
        mysqli_close($conn);
        header('Location: ../View/Home.php');
    }
    else {
        echo "Có lỗi xảy ra <br/>";
        echo "<a href='javascript: history.go(-1)'> Thử lại </a>";
    }
?>
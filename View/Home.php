<?php
    // signed in or not?
    include_once '../CheckSignedIn.php';
    if ($signed_in == false) header('Location: SignIn.php');
   
    // if signed in, session existed
    if (isset($_SESSION['username'])) {
        $user = $_SESSION['username'];
        $sql_get_fullname = "
            SELECT fullname
            FROM user
            WHERE username = '$user'
        ";
        $fullname = $conn->query($sql_get_fullname)->fetch_assoc()['fullname'];
        echo "Wellcome " . "<b>" . $fullname . "</b>";
    }

    //if signed in, cookie existed
    else {
        $user = $_COOKIE['username'];
        $sql_get_fullname = "
            SELECT fullname
            FROM user
            WHERE username = '$user'
        ";
        $fullname = $conn->query($sql_get_fullname)->fetch_assoc()['fullname'];
        echo "Wellcome " . "<b>" . $fullname . "</b>";
    }

    // sign out
    echo "<br/>";
    echo "<a href='../Controller/SignOutController.php'> Đăng xuất </a>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home </title>
    <style>
        table, td, th {  
        border: 1px solid #ddd;
        text-align: left;
        }

        table {
        border-collapse: collapse;
        width: 100%;
        }

        th, td {
        padding: 15px;
        }
    </style>
</head>
<body>
    <script>
        function confirmDeleting(wordID) {
            var r = confirm("Bạn chắc chắn muốn xoá từ này?");
            if (r) window.location.href = "../Controller/DeleteWordController.php?word_id=" + wordID;
        }
    </script>
    <?php
        // get all words
        $sql_select_all_words = "
            SELECT *
            FROM word
            WHERE username = '$user'
        ";
        $words = $conn->query($sql_select_all_words);

        // display all words
        echo "<br/>" . "<br/>";
        echo "<button><a href='CreateWord.php'>Thêm từ</a></button>";
        echo "<br/>" . "<br/>";

        echo "
            <table>
                <tr>
                    <th>STT</th>
                    <th>Từ</th>
                    <th>Loại từ</th>
                    <th>Nghĩa</th>
                    <th>Ghi chú</th>
                    <th>Tuỳ chọn</th>    
                </tr>
        ";
        $i = 0;
        while ($row = $words->fetch_assoc()){
            echo "<tr>"
            . "<td>" . ++$i . "</td>" 
            . "<td>" . $row['word'] . "</td>"
            . "<td>" . $row['type'] . "</td>"
            . "<td>" . $row['meaning'] . "</td>"
            . "<td>" . $row['note'] . "</td>"
            . "<td>" . "<button><a href='UpdateWord.php?word_id=" . $row['word_id'] . "'>Update</a></button> "
            . "<button onclick='confirmDeleting(" . $row['word_id'] . ")'>Delete</button>" . "</td>"
            . "</tr>"; 
        }
        echo "</table>";

        if (isset($_SESSION['create_word'])) {
            echo '<script type="text/javascript">alert("' . $_SESSION['create_word'] . '")</script>';
            unset($_SESSION['create_word']);
        } 
        if (isset($_SESSION['update_word'])) {
            echo '<script type="text/javascript">alert("' . $_SESSION['update_word'] . '")</script>';
            unset($_SESSION['update_word']);
        } 
    ?>
</body>
</html>




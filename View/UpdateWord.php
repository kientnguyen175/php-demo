<?php 
    // signed in or not?
    include_once '../CheckSignedIn.php';
    if (!$signed_in) header('Location: SignIn.php');

    //get data
    $word_id = $_GET['word_id'];
    $sql_select = "
        SELECT *
        FROM word
        WHERE word_id = '$word_id'
    ";
    $res = $conn->query($sql_select)->fetch_assoc();
    $word = $res['word'];
    $type = $res['type'];
    $meaning = $res['meaning'];
    $note = $res['note'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Word</title>
</head>
<body>
    <fieldset>
        <legend>Cập nhật từ</legend>
        <br>
        <b>Ô "Ghi chú" có thể bỏ trống, các ô còn lại cần điền đầy đủ!</b>
        <br>
        <br>
        <form action="../Controller/UpdateWordController.php" method="post">
            <table>
                <tr>
                    <input type="hidden" name="word_id" value="<?php echo $word_id?>">
                </tr>
                <tr>
                    <td>Từ:</td>
                    <td><input type="text" name="word" value="<?php echo $word?>" pattern="[A-Za-z' ]{1,50}" title="'Từ' chỉ cho phép chứa các chữ cái Tiếng anh, khoảng trắng và kí tự '" required></td>
                </tr>
                <tr>
                    <td>Loại từ:</td>
                    <td>
                        <select name="type">
                            <?php
                                foreach ($wordtype as $value) {
                                    echo "<option value='$value' ";
                                    if ($type == $value) echo "selected ";
                                    echo ">$value</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Nghĩa:</td>
                    <td><input type="text" name="meaning" value="<?php echo $meaning?>" pattern="[A-Z0-9a-zăâđêôơưáàạảãắằẵẳặấầậẩẫéẹẽẻèếệểễềìịỉĩíóọõỏòốỗộổồớợởỡờúụũủùứựữừửýỵỹỷỳ' ]{1,50}" title="'Nghĩa' chỉ cho phép các chữ cái, chữ số, khoảng trắng và kí tự '" required></td>
                </tr>
                <tr>
                    <td>Ghi chú:</td>
                    <td><textarea name="note" id="" cols="30" rows="10"><?php echo $note?></textarea></td>
                    
                </tr>
            </table>
            <br>
            <input type="submit" value="Cập nhật từ">
        </form>
        <br>
        <a href='javascript: history.go(-1)'> Quay lại <a>
    </fieldset>
</body>
</html>
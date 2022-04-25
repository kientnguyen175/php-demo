<?php 
    // signed in or not?
    include_once '../CheckSignedIn.php';
    if (!$signed_in) header('Location: SignIn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Create Word </title>
</head>
<body>
    <fieldset>
        <legend>Thêm từ</legend>
        <br>
        <b>(*) nghĩa là bắt buộc cần điền!</b>
        <br>
        <br>
        <form action="../Controller/CreateWordController.php" method="post">
            <table>
                <tr>
                    <td>Từ (*):</td>
                    <td><input type="text" name="word" pattern="[A-Za-z' ]{1,50}" title="'Từ' chỉ cho phép chứa các chữ cái Tiếng anh, khoảng trắng và kí tự '" required></td>
                </tr>
                <tr>
                    <td>Loại từ (*):</td>
                    <td>
                        <select name="type">
                            <option selected disabled>---</option>
                            <option>Danh từ</option>
                            <option>Động từ</option>
                            <option>Tính từ</option>
                            <option>Trạng từ</option>
                            <option>Đại từ</option>
                            <option>Hạn định từ</option>
                            <option>Giới từ</option>
                            <option>Liên từ</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Nghĩa (*):</td>
                    <td><input type="text" name="meaning" pattern="[A-Z0-9a-zăâđêôơưáàạảãắằẵẳặấầậẩẫéẹẽẻèếệểễềìịỉĩíóọõỏòốỗộổồớợởỡờúụũủùứựữừửýỵỹỷỳ' ]{1,50}" title="'Nghĩa' chỉ cho phép các chữ cái, chữ số, khoảng trắng và kí tự '" required></td>
                </tr>
                <tr>
                    <td>Ghi chú:</td>
                    <td><textarea name="note" id="" cols="30" rows="10"></textarea></td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Thêm từ">
        </form>
        <br>
        <a href='javascript: history.go(-1)'> Quay lại <a>
    </fieldset>
</body>
</html>
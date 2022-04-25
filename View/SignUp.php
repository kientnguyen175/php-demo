<?php
    // signed in or not?
    include_once '../CheckSignedIn.php';
    if ($signed_in) header('Location: Home.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign up </title>
</head>
<body>
    <fieldset>
        <legend>Đăng kí tài khoản</legend>
        <br>
        <b>(*) nghĩa là bắt buộc cần điền!</b>
        <br>
        <br>
        <form action="../Controller/SignUpController.php" method="post">
            <table>
                <tr>
                    <td>Fullname (*):</td>
                    <td><input type="text" name="fullname" pattern="[A-Za-zăâđêôơư ]{1,50}" title="Fullname chỉ cho phép các chữ cái và khoảng trắng!" required></td>
                </tr>
                <tr>
                    <td>Username (*):</td>
                    <td><input type="text" name="username" pattern="[A-Za-z0-9_-]{1,50}" title="Username không bao gồm khoảng trắng, chỉ cho phép chứa các chữ cái Tiếng anh, chữ số, kí tự _ và kí tự -" required></td>
                </tr>
                <tr>
                    <td>Password (*):</td>
                    <td><input type="password" name="password" pattern="[A-Za-z0-9.@]{1,50}" title="Password không bao gồm khoảng trắng, chỉ cho phép chứa các chữ cái Tiếng anh, chữ số, kí tự . và kí tự @" required></td>
                </tr>
            </table>
            <input type="submit" value="Đăng kí">
        </form>
        <br>
        <a href='javascript: history.go(-1)'> Đăng nhập </a>
    </fieldset>
</body>
</html>
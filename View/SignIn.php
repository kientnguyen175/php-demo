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
    <title> Sign in </title>
</head>
<body>
    <fieldset>
        <legend>Đăng nhập</legend>
        <form action="../Controller/SignInController.php" method="post">
            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" pattern="[A-Za-z0-9_-]{1,50}" title="Username không bao gồm khoảng trắng, chỉ cho phép chứa các chữ cái Tiếng anh, chữ số, kí tự _ và kí tự -" required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" pattern="[A-Za-z0-9.@]{1,50}" title="Password không bao gồm khoảng trắng, chỉ cho phép chứa các chữ cái Tiếng anh, chữ số, kí tự . và kí tự @" required></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="remember"> Remember me </td>
                </tr>
            </table>
            <input type="submit" value="Đăng nhập">
        </form>
        <br>
        <a href="SignUp.php"> Đăng kí tài khoản </a>
    </fieldset>
</body>
</html>
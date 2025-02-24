<?php
require './db_conn.php';
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $username = $_POST['username'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if ($new_password != $confirm_new_password) {
        echo "<script>alert(`Your password is not matched.......`)</script>";
    } else {

        $usernamesql = "SELECT username FROM admin WHERE username = ?";
        $stmtusername = $conn->prepare($usernamesql);
        $stmtusername->bind_param("s", $username);
        $stmtusername->execute();

        $res = $stmtusername->get_result();

        if ($res->num_rows === 1) {
            $sql = "UPDATE admin SET password = ? WHERE username = ? ";
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('ss', $new_password, $username);

            if ($stmt->execute()) {
                echo "<script>
                                alert(`Your Password updated successfully....`);
                                window.location.href='Admin_login.php';
                            </script>";
            } else {
                echo "<script>alert(`Somthing Error in updation.....`)</script>";
            }
        } else {
            echo "<script>alert(`NO Admin Found Try Again......`)</script>";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center h-screen bg-gradient-to-b from-blue-100 to-white">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center w-96">
        <h2 class="text-2xl font-semibold text-blue-900">Reset Password</h2>
        <form class="mt-4" method="post" action="./forgetpassword.php">
            <input type="text" name="username" placeholder="username" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="password" name="new_password" placeholder="New Password" required minlength="8" maxlength="15" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500" maxlength="8">
            <input type="password" name="confirm_new_password" placeholder="Re-enter New Password" required minlength="8" maxlength="15" class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500" maxlength="8">
            <button type="submit" class="w-full bg-blue-900 text-white py-2 rounded-md hover:bg-blue-700 mt-[2px]" id="btn">Reset Password</button>
        </form>
    </div>
</body>
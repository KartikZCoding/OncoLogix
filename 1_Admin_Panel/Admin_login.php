<?php
session_start();
require './db_conn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        if ($password == $admin['password']) {
            $_SESSION['admin'] = $admin['username'];
            $_SESSION['login_activity'] = time();
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('Admin not found!');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            alert(`Your Right click is disabled......`);
        });
    </script>
</head>

<body class="flex items-center justify-center h-screen bg-gradient-to-b from-blue-100 to-white">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
        <h2 class="text-2xl font-semibold text-blue-900">Admin Login</h2>
        <form class="mt-4" method="post" action="./Admin_login.php" onsubmit="getclick(event)" >
            <input type="text" name="username" placeholder="Username" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="password" name="password" placeholder="Password" required class="w-full px-3 py-2 border rounded-md mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <a href="./forgetpassword.php" class="text-blue-500">Forget password ?</a>
            <button type="submit" class="w-full bg-blue-900 text-white py-2 rounded-md hover:bg-blue-700 mt-[5px]" id="btn">Login</button>
        </form>
    </div>
    <script>
        let uname = document.getElementsByName('username');
        function getclick(event) {
            // to prevent the form submission to run the javascript properly........
            event.preventDefault();
            if (uname !== "") {
                document.getElementById('btn').innerHTML = 'Loging.....';
                setTimeout(() =>  event.target.submit(),500)
            }else{
                    document.getElementById('btn').innerHTML = 'Login';
            }
               return false;
        }
    </script>
</body>

</html>
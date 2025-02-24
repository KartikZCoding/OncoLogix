<?php
ob_start();
session_start();


if (isset($_SESSION["login_activity"])) {
    if (time() - $_SESSION['login_activity'] > 3600) {
        session_unset();
        session_destroy();
        echo "<script>
        alert(`Your session is Expired... `);
        window.location.href='Admin_login.php';
        </script>";
        exit;
    }
}
include("./header.php");
include("../4_M_A_C/index.php");
include("../4_M_A_C/footer.php");

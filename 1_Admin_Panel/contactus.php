<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// if (!isset($_SESSION['admin'])) {
//     header("Location: Admin_login.php");
//     exit();
// }

include("./header.php");
include("../4_M_A_C/contactus.php");
include("../4_M_A_C/footer.php");

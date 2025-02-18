<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start();
include("./header.php");
include("../3_Tumor_Collaction/patient_card.php");

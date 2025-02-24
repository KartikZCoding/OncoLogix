<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("./header.php");
include("../3_Tumor_Collaction/patient_details.php");

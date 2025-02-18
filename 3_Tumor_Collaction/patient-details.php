<?php
include("../1_Admin_Panel/db_conn.php");

// Check if c_id is set in GET or POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['c_id'])) {
    $c_id = intval($_POST['c_id']);  // Ensure it's an integer
} elseif (isset($_GET['c_id'])) {
    $c_id = intval($_GET['c_id']);  // Ensure it's an integer
} else {
    die("❌ Error: No patient selected! Please go back and select a patient.");
}

// SQL Query to Fetch Patient, Doctor, Hospital, and Treatment Data
$query = "SELECT
    ca.c_id AS CancerID,
    ca.cancer_type AS CancerType,
    p.P_name AS PatientName,
    p.age AS PatientAge,
    p.p_image AS PatientImage,
    d.d_name AS DoctorName,
    d.specialization AS DoctorSpe,
    d.experience AS DoctorExp,
    d.d_photo AS DoctorImage,
    d.email AS DoctorEmail,
    h.h_name AS HosName,
    h.email AS HosEmail,
    h.contactNo AS HosContact,
    h.country AS HosCountry,
    h.state AS HosState,
    h.city AS HosCity,
    t.t_given AS TreatGiven,
    t.M_image AS TreatImage
FROM cases ca
JOIN patient p ON ca.p_id = p.p_id
JOIN doctor d ON ca.d_id = d.d_id
JOIN hospital h ON ca.h_id = h.h_id
JOIN treatment t ON ca.t_id = t.t_id
WHERE ca.c_id = ?";

// Prepare and execute the query
$stmt = mysqli_prepare($conn, $query);
if (!$stmt) {
    die("❌ Error: Failed to prepare statement.");
}

// Bind parameter (ensure correct data type)
mysqli_stmt_bind_param($stmt, "i", $c_id);

// Execute statement
if (!mysqli_stmt_execute($stmt)) {
    die("❌ Error: Execution failed.");
}

// Get results
$result = mysqli_stmt_get_result($stmt);

// Fetch data
if ($result && mysqli_num_rows($result) > 0) {
    $patientDetails = mysqli_fetch_assoc($result);
} else {
    die("❌ Error: No records found for Cancer ID $c_id.");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OncoLogix - Case Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-blue-50 to-white">
    <div class="container mx-auto p-6 shadow-md rounded-lg mt-[70px] bg-gradient-to-b from-white to-blue-50 lg:w-[80vw]">
        <div class="flex flex-wrap md:flex-nowrap gap-6">
            <!-- Patient Details Card -->
            <div class="flex-1 bg-white/70 shadow-lg p-6 rounded-lg border border-gray-200">
                <h3 class="text-xl font-semibold text-blue-900 mb-4">Patient Details</h3>
                <div class="flex items-center">
                    <img src="<?= !empty($patientDetails['PatientImage']) ? '../1_Admin_Panel/uploads/' . htmlspecialchars($patientDetails['PatientImage']) : './assets/img/unknown.jpg' ?>"
                        alt="Patient Image" class="w-24 h-24 rounded-lg mr-6">
                    <p class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($patientDetails['PatientName']); ?></p>
                </div>
                <p class="text-gray-700 mt-[8px]"><strong>Age:</strong> <?= htmlspecialchars($patientDetails['PatientAge']); ?></p>
                <p class="text-gray-700"><strong>Diagnosis:</strong> <?= htmlspecialchars($patientDetails['CancerType']); ?></p>
            </div>

            <!-- Doctor Details Card -->
            <div class="flex-1 bg-white/70 shadow-lg p-6 rounded-lg border border-gray-200">
                <h3 class="text-xl font-semibold text-blue-900 mb-4">Doctor Details</h3>
                <div class="flex items-center">
                    <img src="<?= !empty($patientDetails['DoctorImage']) ? '../1_Admin_Panel/uploads/' . htmlspecialchars($patientDetails['DoctorImage']) : './assets/img/unknown.jpg' ?>"
                        alt="Doctor Image" class="w-24 h-24 rounded-lg mr-6">
                    <p class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($patientDetails['DoctorName']); ?></p>
                </div>
                <p class="text-gray-700 mt-[8px]"><strong>Specialization:</strong> <?= htmlspecialchars($patientDetails['DoctorSpe']); ?></p>
                <p class="text-gray-700"><strong>Experience:</strong> <?= htmlspecialchars($patientDetails['DoctorExp']); ?> Years</p>
                <p class="text-gray-700"><strong>Email:</strong> <?= htmlspecialchars($patientDetails['DoctorEmail']); ?></p>
            </div>
        </div>

        <!-- Hospital Information Card -->
        <div class="mt-6 bg-white/70 shadow-lg p-6 rounded-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-blue-900">Hospital Information</h3>
            <p class="text-gray-700"><strong>Name:</strong> <?= htmlspecialchars($patientDetails['HosName']); ?></p>
            <p class="text-gray-700"><strong>Contact:</strong> <?= htmlspecialchars($patientDetails['HosContact']); ?></p>
            <p class="text-gray-700"><strong>Email:</strong> <?= htmlspecialchars($patientDetails['HosEmail']); ?></p>
            <p class="text-gray-700"><strong>Country:</strong> <?= htmlspecialchars($patientDetails['HosCountry']); ?></p>
            <p class="text-gray-700"><strong>State:</strong> <?= htmlspecialchars($patientDetails['HosState']); ?></p>
            <p class="text-gray-700"><strong>City:</strong> <?= htmlspecialchars($patientDetails['HosCity']); ?></p>
        </div>

        <!-- Treatment Details -->
        <div class="mt-6 bg-white/70 shadow-lg p-6 rounded-lg border border-gray-200 flex items-center">
            <img src="<?= !empty($patientDetails['TreatImage']) ? '../1_Admin_Panel/uploads/' . htmlspecialchars($patientDetails['TreatImage']) : './assets/img/unknown.jpg' ?>"
                alt="Treatment Image" class="w-48 h-48 rounded-lg mr-6">
            <div>
                <h3 class="text-xl font-semibold text-blue-900">Given Treatment</h3>
                <p class="font-semibold"><?= htmlspecialchars($patientDetails['TreatGiven']); ?></p>
            </div>
        </div>
    </div>

    <?php include("./footer.php") ?>
</body>

</html>
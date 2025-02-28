<?php
ob_start();
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../1_Admin_Panel/db_conn.php");

// Check if c_id is set via POST or GET and store it in session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['c_id'])) {
    $_SESSION['c_id'] = intval($_POST['c_id']);
    // $_SESSION['c_id_time'] = time();
} elseif (isset($_GET['c_id'])) {
    $_SESSION['c_id'] = intval($_GET['c_id']);
    // $_SESSION['c_id_time'] = time();
}

if (!isset($_SESSION['c_id'])) {
    die("❌ Error: No patient selected! Please go back and select a patient.");
}

$c_id = intval($_SESSION['c_id']);

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


$stmt = mysqli_prepare($conn, $query);
if (!$stmt) {
    die("❌ Error: Failed to prepare SQL statement.");
}

mysqli_stmt_bind_param($stmt, "i", $c_id);
if (!mysqli_stmt_execute($stmt)) {
    die("❌ Error: Query execution failed.");
}


$result = mysqli_stmt_get_result($stmt);
if (!$result) {
    die("❌ Error: Failed to retrieve results.");
}


if (mysqli_num_rows($result) > 0) {
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</head>

<body class="bg-gradient-to-b from-blue-50 to-white">
    <div class="container mx-auto p-6 shadow-md rounded-lg mt-[70px] bg-gradient-to-b from-white to-blue-50 lg:w-[80vw]">
        <button id="downloadPDF" onclick="generatePDF()" class="mb-4 ml-2 px-6 py-2 bg-blue-600 text-white rounded-lg shadow">Download PDF</button>
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

    <?php include("../4_M_A_C/footer.php") ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("downloadPDF").addEventListener("click", function() {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();

                let y = 20; // Initial Y position

                // Function to Load Images and Generate PDF
                function loadImage(url, callback) {
                    const img = new Image();
                    img.crossOrigin = "Anonymous"; // Avoid CORS issues
                    img.src = url;
                    img.onload = function() {
                        callback(img);
                    };
                }

                function generatePDF(patientImg, doctorImg, treatImg) {
                    // Title
                    doc.setFont("helvetica", "bold");
                    doc.setFontSize(18);
                    doc.text("OncoLogix - Case Report", 60, y);
                    y += 10;

                    // Patient Details
                    doc.setFontSize(14);
                    doc.text("Patient Details", 10, y);
                    y += 8;
                    if (patientImg) doc.addImage(patientImg, "JPEG", 10, y, 30, 30);
                    doc.setFontSize(12);
                    doc.text(`Name: <?= htmlspecialchars($patientDetails['PatientName']); ?>`, 50, y + 6);
                    doc.text(`Age: <?= htmlspecialchars($patientDetails['PatientAge']); ?>`, 50, y + 12);
                    doc.text(`Diagnosis: <?= htmlspecialchars($patientDetails['CancerType']); ?>`, 50, y + 18);
                    y += 40;

                    // Doctor Details
                    doc.setFontSize(14);
                    doc.text("Doctor Details", 10, y);
                    y += 8;
                    if (doctorImg) doc.addImage(doctorImg, "JPEG", 10, y, 30, 30);
                    doc.setFontSize(12);
                    doc.text(`Name: <?= htmlspecialchars($patientDetails['DoctorName']); ?>`, 50, y + 6);
                    doc.text(`Specialization: <?= htmlspecialchars($patientDetails['DoctorSpe']); ?>`, 50, y + 12);
                    doc.text(`Experience: <?= htmlspecialchars($patientDetails['DoctorExp']); ?> Years`, 50, y + 18);
                    doc.text(`Email: <?= htmlspecialchars($patientDetails['DoctorEmail']); ?>`, 50, y + 24);
                    y += 40;

                    // Hospital Information
                    doc.setFontSize(14);
                    doc.text("Hospital Information", 10, y);
                    y += 8;
                    doc.setFontSize(12);
                    doc.text(`Name: <?= htmlspecialchars($patientDetails['HosName']); ?>`, 10, y);
                    y += 6;
                    doc.text(`Contact: <?= htmlspecialchars($patientDetails['HosContact']); ?>`, 10, y);
                    y += 6;
                    doc.text(`Email: <?= htmlspecialchars($patientDetails['HosEmail']); ?>`, 10, y);
                    y += 6;
                    doc.text(`Location: <?= htmlspecialchars($patientDetails['HosCity']) . ', ' . htmlspecialchars($patientDetails['HosState']) . ', ' . htmlspecialchars($patientDetails['HosCountry']); ?>`, 10, y);
                    y += 20;

                    // Treatment Details
                    doc.setFontSize(14);
                    doc.text("Treatment Details", 10, y);
                    y += 8;
                    if (treatImg) doc.addImage(treatImg, "JPEG", 10, y, 40, 40);
                    doc.setFontSize(12);
                    let treatmentText = `Treatment Given: <?= htmlspecialchars($patientDetails['TreatGiven']); ?>`;
                    let splitTreatmentText = doc.splitTextToSize(treatmentText, 140);
                    doc.text(splitTreatmentText, 60, y + 10);
                    y += 50;

                    // Save PDF
                    doc.save("Patient_Case_Report.pdf");
                }

                // Image URLs
                let patientImageUrl = "<?= !empty($patientDetails['PatientImage']) ? '../1_Admin_Panel/uploads/' . htmlspecialchars($patientDetails['PatientImage']) : './assets/img/unknown.jpg' ?>";
                let doctorImageUrl = "<?= !empty($patientDetails['DoctorImage']) ? '../1_Admin_Panel/uploads/' . htmlspecialchars($patientDetails['DoctorImage']) : './assets/img/unknown.jpg' ?>";
                let treatImageUrl = "<?= !empty($patientDetails['TreatImage']) ? '../1_Admin_Panel/uploads/' . htmlspecialchars($patientDetails['TreatImage']) : './assets/img/unknown.jpg' ?>";

                // Load Images & Generate PDF
                loadImage(patientImageUrl, function(patientImg) {
                    loadImage(doctorImageUrl, function(doctorImg) {
                        loadImage(treatImageUrl, function(treatImg) {
                            generatePDF(patientImg, doctorImg, treatImg);
                        });
                    });
                });
            });
        });
    </script>

</body>

</html>
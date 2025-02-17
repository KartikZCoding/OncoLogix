<?php
ob_start();
include("../1_Admin_Panel/db_conn.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cancerType = mysqli_real_escape_string($conn, $_POST['cancer_type']);
    header("Location: pat_card.php?cancer_type=" . urlencode($cancerType));
    exit();
}

$patients = [];
$count = 0;
if (isset($_GET['cancer_type'])) {
    $cancerType = mysqli_real_escape_string($conn, $_GET['cancer_type']);
    $query = "SELECT 
        p.P_name AS Name,
        p.age AS Age,
        p.p_image as Image,
        c.cancer_name AS CancerType,
        h.h_name AS Hospital,
        h.country AS Country
    FROM cases ca
    JOIN patient p ON ca.p_id = p.p_id
    JOIN cancer c ON ca.cancer_type = c.cancer_name
    JOIN hospital h ON ca.h_id = h.h_id
    WHERE c.cancer_name = '$cancerType';";

    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $count++;
            $patients[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OncoLogix - Patient Cards</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <style>
        .count-box {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            font-size: 20px;
            font-weight: bold;
            color: #1e3a8a;
        }

        .divider {
            height: 60px;
            width: 2px;
            background-color: #ccc;
            margin: 0 6px;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-blue-50 to-white flex flex-col items-center min-h-screen pt-0 relative">
    <div class="count-box mt-[80px]">Patients: <?php echo $count; ?></div>
    <div class="flex-grow flex flex-col justify-center items-center w-full px-4 md:px-0 mt-10">
        <h1 class="text-3xl font-bold text-blue-900 text-center mb-8">Patient Records</h1>
        <div class="flex flex-col space-y-6 w-full max-w-4xl mb-10">
            <?php if (!empty($patients)): ?>
                <?php foreach ($patients as $patient): ?>
                    <div class="bg-white shadow-md rounded-lg p-6 flex flex-col md:flex-row items-center md:justify-between w-full md:w-auto">
                        <img src="<?= !empty($patient['Image']) ? '../1_Admin_Panel/uploads/' . htmlspecialchars($patient['Image']) : './assets/img/unknown.jpg' ?>"
                            alt="Patient Image" class="w-40 h-40 rounded-lg object-cover mr-6 mb-4 md:mb-0">
                        <div class="flex-1 flex flex-col md:flex-row justify-between items-center w-full">
                            <div class="text-center md:text-left">
                                <h2 class="text-xl font-semibold text-blue-900"><?= htmlspecialchars($patient['Name']) ?></h2>
                                <p class="text-gray-700 text-lg"><strong>Age:</strong> <?= htmlspecialchars($patient['Age']) ?></p>
                            </div>
                            <div class="hidden md:block divider"></div>
                            <div class="text-center md:text-left">
                                <p class="text-gray-700 text-lg"><strong>Cancer:</strong> <?= htmlspecialchars($patient['CancerType']) ?></p>
                                <p class="text-gray-700 text-lg"><strong>Hospital:</strong> <?= htmlspecialchars($patient['Hospital']) ?></p>
                            </div>
                            <div class="hidden md:block divider"></div>
                            <div class="text-center md:text-left">
                                <p class="text-gray-700 text-lg"><strong>Country:</strong> <?= htmlspecialchars($patient['Country']) ?></p>
                            </div>
                        </div>
                        <a href="./patient-details.php" class="bg-blue-700 text-white px-3 py-[8px] rounded-lg text-lg hover:bg-blue-500 transition mt-4 md:mt-0 md:ml-[11px]">View More</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-700 text-center text-lg">No patient records found for the selected cancer type.</p>
            <?php endif;
            ob_end_flush();  ?>
        </div>
    </div>
    <footer class="w-full text-center py-6 bg-gray-100 text-gray-700 text-sm md:text-base">
        © 2025 OncoLogix | Uniting Against Cancers
    </footer>
</body>

</html>
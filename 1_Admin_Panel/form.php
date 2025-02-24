<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header("Location:Admin_login.php");
    exit();
}

include("./header.php");
include("./db_conn.php");


// Fetch cancer types from database
$cancer_types = [];
$result = $conn->query("SELECT cancer_name FROM cancer");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cancer_types[] = $row['cancer_name'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $case_id = $_POST['case_id'];
    $pat_cancer_date = $_POST['pat_cancer_date'];
    $cancer_name = $_POST['cancer_type'];
    $pname = $_POST['pname'];
    $page = $_POST['page'];
    $doctor_name = $_POST['doctor_name'];
    $specialization = $_POST['specialization'];
    $experience = $_POST['experience'];
    $doc_email = $_POST['doctor_email'];
    $treatment_procedure = $_POST['treatment_procedure'];
    $hospital_name = $_POST['hospital_name'];
    $hospital_email = $_POST['hospital_email'];
    $contact_number = $_POST['contact_number'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];

    // File uploads
    $target_dir = "uploads/";
    $patientImage = $_FILES['patientImage']['name'];
    $doctorImage = $_FILES['doctorImage']['name'];
    $treatmentImage = $_FILES['treatmentImage']['name'];

    move_uploaded_file($_FILES['patientImage']['tmp_name'], $target_dir . $patientImage);
    move_uploaded_file($_FILES['doctorImage']['tmp_name'], $target_dir . $doctorImage);
    move_uploaded_file($_FILES['treatmentImage']['tmp_name'], $target_dir . $treatmentImage);

    // Insert into tables
    $stmt = $conn->prepare("INSERT INTO patient (P_name, age, p_image) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $pname, $page, $patientImage);
    $stmt->execute();
    $p_id = $stmt->insert_id;

    $stmt = $conn->prepare("INSERT INTO doctor (d_name, experience, specialization, d_photo, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $doctor_name, $experience, $specialization, $doctorImage, $doc_email);
    $stmt->execute();
    $d_id = $stmt->insert_id;

    $stmt = $conn->prepare("INSERT INTO hospital (h_name, email, contactNo, country, state, city) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $hospital_name, $hospital_email, $contact_number, $country, $state, $city);
    $stmt->execute();
    $h_id = $stmt->insert_id;

    $stmt = $conn->prepare("INSERT INTO treatment (t_given, M_image) VALUES (?, ?)");
    $stmt->bind_param("ss", $treatment_procedure, $treatmentImage);
    $stmt->execute();
    $t_id = $stmt->insert_id;

    $stmt = $conn->prepare("INSERT INTO cases (p_id, d_id, h_id, t_id, cancer_type, patient_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiss", $p_id, $d_id, $h_id, $t_id, $cancer_name, $pat_cancer_date);
    $stmt->execute();

    echo "<script>alert('Case inserted successfully');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Case Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        if (performance.navigation.type === 2) {
            location.reload(); // Force refresh when navigating back
        }
    </script>
</head>

<body class="bg-gradient-to-b from-blue-200 to-white-50">
    <div class="max-w-5xl mx-auto p-6 rounded-lg shadow-xl bg-white/30 backdrop-blur-md border border-gray-300 mt-[20px]">
        <h2 class="text-2xl font-bold text-center text-blue-900 mb-6">Tumor Case Form</h2>

        <form id="myform" action="./form.php" method="POST" enctype="multipart/form-data">

            <!-- Case ID & Cancer Type -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="bg-gray-50/50 p-4 rounded-lg shadow-md backdrop-blur-md">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Case Date</h3>
                    <input type="date" name="pat_cancer_date" class="w-full p-2 border rounded-md cursor-pointer" placeholder="Enter Case Date" required>
                </div>
                <div class="bg-gray-50/50 p-4 rounded-lg shadow-md backdrop-blur-md">
                    <label class="block text-gray-600 font-semibold mb-2">Cancer Type:</label>
                    <select name="cancer_type" class="w-full p-2 border rounded-md bg-white shadow-sm cursor-pointer" required>
                        <option value="">Select Cancer Type</option>
                        <?php foreach ($cancer_types as $type) { ?>
                            <option value="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!-- Case ID & Cancer Type
            <div class="bg-gray-50/50 p-4 rounded-lg shadow-md backdrop-blur-md mb-4">
                <label class="block text-gray-600 font-semibold mb-2">Cancer Type:</label>
                <select name="cancer_type" class="w-full p-2 border rounded-md bg-white shadow-sm" required>
                    <option value="">Select Cancer Type</option>
                    <?php foreach ($cancer_types as $type) { ?>
                        <option value="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></option>
                    <?php } ?>
                </select>

            </div> -->

            <div class="grid grid-cols-2 gap-4 mb-4">
                <!-- Patient Details -->
                <div class="bg-gray-50/50 p-4 rounded-lg shadow-md backdrop-blur-md mb-4">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Patient Details</h3>
                    <label class="block text-gray-600">Name:</label>
                    <input type="text" name="pname" class="w-full p-2 border rounded-md mb-2" placeholder="Enter Patient Name" required>

                    <label class="block text-gray-600">Age:</label>
                    <input type="number" name="page" class="w-full p-2 border rounded-md mb-2" placeholder="Enter Age" required>

                    <label class="block text-gray-600">Patient Image:</label>
                    <input type="file" name="patientImage" class="w-full p-2 border rounded-md" accept="image/*" required>
                </div>

                <!-- Doctor Details -->
                <div class="bg-gray-50/50 p-4 rounded-lg shadow-md backdrop-blur-md mb-4">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Doctor Details</h3>
                    <label class="block text-gray-600">Name:</label>
                    <input type="text" name="doctor_name" class="w-full p-2 border rounded-md mb-2" placeholder="Enter Doctor Name" required>

                    <label class="block text-gray-600">Specialization:</label>
                    <input type="text" name="specialization" class="w-full p-2 border rounded-md mb-2" placeholder="Enter Specialization" required>

                    <label class="block text-gray-600">Experience:</label>
                    <input type="number" name="experience" class="w-full p-2 border rounded-md mb-2" placeholder="Enter Experience (in years)" required>

                    <label class="block text-gray-600">Doctor Email:</label>
                    <input type="email" name="doctor_email" class="w-full p-2 border rounded-md mb-2" placeholder="Enter Doctor Email" required>

                    <label class="block text-gray-600">Doctor Image:</label>
                    <input type="file" name="doctorImage" class="w-full p-2 border rounded-md" accept="image/*" required>

                </div>
            </div>

            <!-- Treatment Details -->
            <div class="bg-gray-50/50 p-4 rounded-lg shadow-md backdrop-blur-md mb-4">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Treatment Details</h3>
                <label class="block text-gray-600">Treatment Procedure:</label>
                <textarea name="treatment_procedure" class="w-full p-2 border rounded-md mb-2" placeholder="Enter Treatment Procedure" required></textarea>

                <label class="block text-gray-600">Treatment Image:</label>
                <input type="file" name="treatmentImage" class="w-full p-2 border rounded-md" accept="image/*" required>
            </div>

            <!-- Hospital & Location Details -->
            <div class="bg-gray-50/50 p-4 rounded-lg shadow-md backdrop-blur-md mb-4">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Hospital & Location Details</h3>
                <label class="block text-gray-600">Hospital Name:</label>
                <input type="text" name="hospital_name" class="w-full p-2 border rounded-md mb-2" placeholder="Enter Hospital Name" required>

                <label class="block text-gray-600">Hospital Email:</label>
                <input type="email" name="hospital_email" class="w-full p-2 border rounded-md mb-2" placeholder="Enter Hospital Email" required>

                <label class="block text-gray-600">Contact Number:</label>
                <input type="text" name="contact_number" class="w-full p-2 border rounded-md mb-2" placeholder="Enter Contact Number" required>

                <label class="block text-gray-600">Country:</label>
                <input type="text" name="country" class="w-full p-2 border rounded-md mb-2" placeholder="Enter Country" required>

                <label class="block text-gray-600">State:</label>
                <input type="text" name="state" class="w-full p-2 border rounded-md mb-2" placeholder="Enter State" required>

                <label class="block text-gray-600">City:</label>
                <input type="text" name="city" class="w-full p-2 border rounded-md mb-2" placeholder="Enter City" required>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between">
                <button type="submit" class="w-1/2 bg-blue-600 text-white py-2 rounded-lg mt-4 transition duration-300 hover:bg-blue-800 mr-2">Submit Case</button>
                <button type="reset" class="w-1/2 bg-gray-400 text-white py-2 rounded-lg mt-4 transition duration-300 hover:bg-gray-600">Reset Form</button>
            </div>
        </form>
    </div>

    <?php
    include("../4_M_A_C/footer.php");
    ?>
    <script>
        document.getElementById("myForm").addEventListener("submit", function() {
            setTimeout(() => {
                this.reset(); // Clear form fields
            }, 1000); // Delay to allow form submission
        });
    </script>
</body>

</html>
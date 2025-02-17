<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OncoLogix - Cancer Types</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        if (performance.navigation.type === 2) {
            location.reload(); // Force refresh when navigating back
        }
    </script>
</head>

<body class="bg-gradient-to-b from-blue-50 to-white">
    <div class="container mx-auto p-6 shadow-md rounded-lg mt-[70px] bg-gradient-to-b from-white to-blue-50 lg:w-[60vw]">
        <h2 class="text-xl font-semibold text-blue-900 mb-4">Select Cancer Type</h2>

        <form action="./pat_card.php" method="POST" enctype="multipart/form-data">
            <!-- Dropdown -->
            <div class="mb-6">
                <select id="cancerType" name="cancer_type" class="w-full p-3 border rounded-lg shadow-md text-gray-700 focus:ring focus:ring-blue-300">
                    <option value="sel">Select</option>
                    <option value="Lung Cancer">Lung Cancer</option>
                    <option value="Kidney Cancer">Kidney Cancer</option>
                    <option value="Stomach Cancer">Stomach Cancer</option>
                    <option value="Brain Cancer">Brain Cancer</option>
                    <option value="Blood Cancer">Blood Cancer</option>
                </select>
            </div>

            <!-- Cancer Details Card -->
            <div class="cardd bg-white/70 shadow-lg p-6 rounded-lg border border-gray-200 hidden" id="card-details">
                <h3 id="cancerName" class="text-2xl font-semibold text-gray-800 text-center mb-4"></h3>
                <div class="flex items-center">
                    <img id="cancerImage" src="./unknown.jpg" alt="Cancer Image" class="w-40 h-40 rounded-lg mr-6 mb-[10px]">
                    <div class="flex-1">
                        <p id="cancerDescription" class="text-gray-700 text-sm mb-3 font-semibold"></p>
                        <hr class="border-gray-300 my-3">
                        <p id="cancerSymptoms" class="text-gray-700 text-sm font-semibold"></p>
                        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 transition">
                            Cases Details
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <footer class="text-center py-6 bg-gray-100 mt-[350px] text-gray-700 text-sm md:text-base" id="main-footer">
        © 2025 OncoLogix | Uniting Against Cancers
    </footer>
    <script>
        const cancerData = {
            lung: {
                image: "./assets/img/lu.jpg",
                name: "Lung Cancer",
                description: "Lung cancer is the uncontrolled growth of abnormal cells in one or both lungs.",
                symptoms: "Persistent cough, chest pain, shortness of breath, weight loss."
            },
            kidney: {
                image: "./assets/img/k.jpg",
                name: "Kidney Cancer",
                description: "Kidney cancer starts in the kidneys, which filter blood and remove waste from the body.",
                symptoms: "Blood in urine, lower back pain, loss of appetite, fever."
            },
            stomach: {
                image: "./assets/img/s.jpg",
                name: "Stomach Cancer",
                description: "Stomach cancer develops in the lining of the stomach and can spread to other organs.",
                symptoms: "Abdominal pain, bloating, nausea, loss of appetite."
            },
            brain: {
                image: "./assets/img/b.jpg",
                name: "Brain Cancer",
                description: "Brain tumors are abnormal growths of cells in the brain that can be benign or malignant.",
                symptoms: "Headaches, vision problems, memory loss, difficulty balancing."
            },
            blood: {
                image: "./assets/img/bl.jpg",
                name: "Blood Cancer",
                description: "Blood cancer affects blood-forming tissues, including bone marrow and lymphatic system.",
                symptoms: "Frequent infections, bruising, night sweats, fatigue."
            }
        };

        // Mapping full names to keys
        const cancerMapping = {
            "Lung Cancer": "lung",
            "Kidney Cancer": "kidney",
            "Stomach Cancer": "stomach",
            "Brain Cancer": "brain",
            "Blood Cancer": "blood"
        };

        document.getElementById('cancerType').addEventListener('change', function() {
            const selected = this.value;
            const mappedValue = cancerMapping[selected]; // Convert full name to key
            const card = document.getElementById('card-details');

            if (!mappedValue) {
                card.classList.add("hidden"); // Hide when no valid selection
            } else {
                card.classList.remove("hidden"); // Show the card
                document.getElementById('cancerImage').src = cancerData[mappedValue].image;
                document.getElementById('cancerName').textContent = cancerData[mappedValue].name;
                document.getElementById('cancerDescription').textContent = "Description: " + cancerData[mappedValue].description;
                document.getElementById('cancerSymptoms').textContent = "Symptoms: " + cancerData[mappedValue].symptoms;
            }
        });
    </script>



</body>

</html>
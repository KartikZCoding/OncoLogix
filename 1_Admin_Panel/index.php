<?php
include("./header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OncoLogix</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-[#E3ECF8] to-[#FFFFFF] text-gray-800 flex flex-col min-h-screen">

    <!-- Main Content: Pushes Footer Down -->
    <main class="flex-grow flex flex-col items-center justify-center px-6 md:px-16">
        <div class="flex flex-col sm:flex-col md:flex-col lg:flex-row items-center justify-center w-full">
            <!-- Left: Image -->
            <div class="w-full flex justify-center mt-4">
                <img src="./assets/img/bg.png" alt="Medical Research" class="w-full h-auto max-w-md md:max-w-full rounded-lg shadow-lg object-contain">
            </div>

            <!-- Right: Introduction Text -->
            <div class="w-full text-center md:text-left mt-8 md:mt-5 px-6 ml-4">
                <h1 class="text-4xl font-bold text-blue-800"> Better cancer outcomes through improved pathology diagnosis.</h1>
                <p class="mt-4 text-lg leading-relaxed" align="justify">
                    The Tumor Registry is committed to advancing cancer diagnosis and treatment through specialized pathology research.
                    Browse, study, and diagnose with a vast collection of digital microscopic tumor images from across the globe.
                </p>
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-blue-900 mb-2">Current Tumor Cases:</h3>
                    <p class="text-3xl font-bold text-blue-700" id="tumor-case-count">Loading...</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Function to simulate fetching tumor case count from an API
        function fetchTumorCaseCount() {
            const randomTumorCaseCount = Math.floor(Math.random() * 1000000) + 10000000;
            document.getElementById("tumor-case-count").innerText = randomTumorCaseCount.toLocaleString();
        }

        setInterval(fetchTumorCaseCount, 5000);
        window.onload = fetchTumorCaseCount;
    </script>
    <?php include("./footer.php")  ?>
</body>

</html>
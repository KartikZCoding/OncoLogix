<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OncoLogix</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-[#E3ECF8] to-[#FFFFFF] text-gray-800 flex flex-col min-h-screen">

    <main class="flex-grow flex flex-col items-center justify-center px-6 md:px-16">
        <!-- Hero Section -->
        <div class="w-full max-w-7xl flex flex-col lg:flex-row items-center justify-center space-y-10 lg:space-y-0 lg:space-x-8 mt-16 md:mt-24">
            <div class="w-full lg:w-1/2 flex justify-center">
                <img src="../assets/img/bg.png" alt="Medical Research" class="w-full max-w-2xl rounded-lg shadow-lg">
            </div>
            <div class="w-full lg:w-1/2 px-6">
                <h1 class="text-4xl font-bold text-blue-800">Better cancer outcomes through improved pathology diagnosis.</h1>
                <p class="mt-4 text-lg leading-relaxed">
                    The Tumor Registry is committed to advancing cancer diagnosis and treatment through specialized pathology research.
                    Browse, study, and diagnose with a vast collection of digital microscopic tumor images from across the globe.
                </p>
                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-blue-900 mb-2">Current Tumor Cases:</h3>
                    <p class="text-3xl font-bold text-blue-700" id="tumor-case-count">Loading...</p>
                </div>
            </div>
        </div>

        <!-- How OncoLogix Works Section -->
        <section class="w-full max-w-7xl bg-white p-8 rounded-lg shadow-md mt-16">
            <h2 class="text-2xl font-bold text-blue-700 text-center">How OncoLogix Works?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-6">
                <div class="flex flex-col items-center">
                    <img src="../assets/main_page_img/data_collect.png"
                        alt="Doctor Collaboration"
                        class="w-80 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-blue-800 mt-4">Global Cancer Cases</h3>
                    <p class="text-gray-700 text-center mt-2">Access a vast collection of real-world tumor cases categorized by cancer types.</p>
                </div>
                <div class="flex flex-col items-center">
                    <img src="../assets/main_page_img/doctor_collab.png"
                        alt="Doctor Collaboration"
                        class="w-80 rounded-lg shadow-md">

                    <h3 class="text-lg font-semibold text-blue-800 mt-4">Doctor Collaboration</h3>
                    <p class="text-gray-700 text-center mt-2">Learn from experienced oncologists worldwide and apply best treatment approaches.</p>
                </div>
                <div class="flex flex-col items-center">
                    <img src="../assets/main_page_img/treatment.png"
                        alt="Doctor Collaboration"
                        class="w-80 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-blue-800 mt-4">Treatment Insights</h3>
                    <p class="text-gray-700 text-center mt-2">Discover successful treatment methods used in top hospitals worldwide.</p>
                </div>
            </div>
        </section>

        <!-- Why Choose OncoLogix -->
        <section class="bg-blue-100 p-6 md:p-8 rounded-lg shadow-md mt-12 w-full max-w-7xl">
            <h2 class="text-2xl font-bold text-blue-700 text-center">Why Choose OncoLogix?</h2>
            <ul class="mt-6 space-y-4 text-gray-800 text-lg">
                <li>✅ <span class="font-semibold">Verified Global Data:</span> Trusted case studies from leading hospitals and research centers.</li>
                <li>✅ <span class="font-semibold">Patient-Centric Approach:</span> Ensuring the best treatment recommendations for every patient.</li>
                <li>✅ <span class="font-semibold">Collaborative Network:</span> Work with a worldwide network of oncologists and pathologists.</li>
                <li>✅ <span class="font-semibold">Easy Access:</span> A user-friendly platform for professionals to access cancer case studies and pathology reports.</li>
            </ul>
        </section>

        <!-- Latest Research & Innovations
        <section class="bg-white p-6 md:p-8 rounded-lg shadow-md mt-12 w-full max-w-7xl">
            <h2 class="text-2xl font-bold text-blue-700 text-center">Latest Research & Innovations</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
                <div>
                    <h3 class="text-lg font-semibold text-blue-800">New Breakthroughs in Cancer Treatment</h3>
                    <p class="text-gray-700 mt-2">Researchers have recently discovered novel drug combinations that improve treatment effectiveness.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-blue-800">Advancements in Tumor Diagnosis</h3>
                    <p class="text-gray-700 mt-2">Pathologists are utilizing advanced imaging techniques to improve tumor detection accuracy.</p>
                </div>
            </div>
        </section> -->
    </main>

    <script>
        function fetchTumorCaseCount() {
            const randomTumorCaseCount = Math.floor(Math.random() * 1000000) + 10000000;
            document.getElementById("tumor-case-count").innerText = randomTumorCaseCount.toLocaleString();
        }

        setInterval(fetchTumorCaseCount, 5000);
        window.onload = fetchTumorCaseCount;
    </script>

</body>

</html>
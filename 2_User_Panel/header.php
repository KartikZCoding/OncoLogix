<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <link rel="icon" type="image/jpg" href="../logo.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Header -->
    <header class="flex justify-between items-center p-5 bg-white shadow-md relative w-full">
        <a href="./index.php" class="ml-0 lg:ml-[100px] md:ml-[50px] sm:ml-0">
            <h1 class="text-3xl font-bold text-blue-900 flex items-center">
                <span class="text-black">O</span><span class="text-blue-500">L</span>
                <span class="ml-2 text-gray-600 hidden lg:inline">OncoLogix</span>
            </h1>
        </a>

        <div class="flex items-center md:hidden space-x-4 relative">
            <button id="menu-toggle" class="text-gray-700 focus:outline-none text-3xl">☰</button>
        </div>

        <!-- Desktop Navigation -->
        <nav id="menu" class="hidden md:flex md:items-center space-x-6 font-bold mr-0 lg:mr-[100px] md:mr-[50px] sm:mr-0">
            <a href="./index.php" class="text-gray-700 hover:text-blue-700">Home</a>
            <a href="./tumor_coll.php" class="text-gray-700 hover:text-blue-700">Tumor Collections</a>
            <a href="./aboutus.php" class="text-gray-700 hover:text-blue-700">About Us</a>
            <a href="./contactus.php" class="text-gray-700 hover:text-blue-700">Contact Us</a>
        </nav>
    </header>

    <!-- Mobile Menu Dropdown -->
    <div id="mobile-menu" class="hidden flex flex-col items-center bg-white shadow-md w-full md:hidden font-bold">
        <a href="./index.php" class="py-2 text-gray-700 hover:text-blue-700">Home</a>
        <a href="./tumor_coll.php" class="py-2 text-gray-700 hover:text-blue-700">Tumor Collections</a>
        <a href="./aboutus.php" class="py-2 text-gray-700 hover:text-blue-700">About Us</a>
        <a href="./contactus.php" class="py-2 text-gray-700 hover:text-blue-700">Contact Us</a>
    </div>

    <!-- JavaScript for Dropdown and Toggle -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuToggle = document.getElementById("menu-toggle");
            const mobileMenu = document.getElementById("mobile-menu");

            // Toggle Mobile Menu
            menuToggle.addEventListener("click", function(event) {
                event.stopPropagation(); // Prevent event bubbling
                mobileMenu.classList.toggle("hidden");
            });

            // Close Mobile Menu when clicking outside
            document.addEventListener("click", function(event) {
                if (!menuToggle.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add("hidden");
                }
            });

            // Prevent menu from closing when clicking inside
            mobileMenu.addEventListener("click", function(event) {
                event.stopPropagation();
            });
        });
    </script>
</body>

</html>
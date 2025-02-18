<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../logo.jpg">
    <title>User_panel</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuToggle = document.getElementById("menu-toggle");
            const mobileMenu = document.getElementById("mobile-menu");

            // Toggle menu on button click
            menuToggle.addEventListener("click", function(event) {
                event.stopPropagation(); // Prevents click from triggering the document event
                mobileMenu.classList.toggle("hidden");
            });

            // Close menu when clicking outside
            document.addEventListener("click", function(event) {
                if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                    mobileMenu.classList.add("hidden");
                }
            });
        });
    </script>

</head>

<body>
    <!-- Header -->
    <header class="flex justify-between items-center p-5 bg-white shadow-md relative w-full">
        <a href="./index.php">
            <h1 class="text-3xl font-bold text-blue-900 flex items-center ml-0 sm:ml-10">
                <span class="text-black">O</span><span class="text-blue-500">L</span>
                <span class="ml-2 text-gray-600 hidden sm:hidden md:hidden lg:inline">OncoLogix</span> <!-- Change from 'hidden sm:inline' to 'md:inline hidden' -->
            </h1>
        </a>
        <!-- Mobile Menu Button -->
        <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
            ☰
        </button>

        <!-- Navigation Menu -->
        <nav id="menu" class="hidden md:flex md:items-center space-x-6 mr-[50px] font-bold">
            <a href="./index.php" class="text-gray-700 hover:text-blue-700">Home</a>
            <a href="./tumor_coll.php" class="text-gray-700 hover:text-blue-700">Tumor Collections</a>
            <a href="./aboutus.php" class="text-gray-700 hover:text-blue-700">About Us</a>
            <a href="./contactus.php" class="text-gray-700 hover:text-blue-700">Contact Us</a>
        </nav>
    </header>

    <!-- Mobile Menu Dropdown -->
    <div id="mobile-menu" class="hidden flex flex-col items-center bg-white shadow-md md:hidden font-bold w-full">
        <a href="./index.php" class="py-2 text-gray-700 hover:text-blue-700">Home</a>
        <a href="./tumor_coll.php" class="py-2 text-gray-700 hover:text-blue-700">Tumor Collections</a>
        <a href="./aboutus.php" class="py-2 text-gray-700 hover:text-blue-700">About Us</a>
        <a href="./contactus.php" class="py-2 text-gray-700 hover:text-blue-700">Contact Us</a>
    </div>
</body>

</html>
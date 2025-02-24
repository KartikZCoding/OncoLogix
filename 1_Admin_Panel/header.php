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
    <title>Admin Panel</title>
    <link rel="icon" type="image/jpg" href="../logo.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Header -->
    <header class="flex justify-between items-center p-5 bg-white shadow-md relative w-full">
        <a href="./index.php" class="ml-0 lg:ml-[100px] md:ml-[50px] sm:ml-0"> <!-- Added left margin on desktop, removed on md & sm -->
            <h1 class="text-3xl font-bold text-blue-900 flex items-center">
                <span class="text-black">O</span><span class="text-blue-500">L</span>
                <span class="ml-2 text-gray-600 hidden lg:inline">OncoLogix</span>
            </h1>
        </a>

        <!-- Mobile View -->
        <div class="flex items-center md:hidden space-x-4 relative">
            <?php if (isset($_SESSION['admin'])) { ?>
                <span class="text-gray-700 font-bold"><?php echo $_SESSION['admin']; ?></span>
            <?php } ?>
            <button id="profile-button-mobile" class="focus:outline-none relative">
                <img src="./assets/img/unkonw.jpg" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-500">
            </button>

            <!-- Mobile Profile Dropdown -->
            <div id="dropdown-menu-mobile" class="hidden absolute top-full right-0 mt-2 w-[170px] bg-white shadow-md rounded-md border z-50">
                <?php if (isset($_SESSION['admin'])) { ?>
                    <a href="logout.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
                    <a href="./changepassword.php" class="text-blue-500">Change password</a>
                <?php } else { ?>
                    <a href="Admin_login.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Login</a>
                <?php } ?>
            </div>

            <button id="menu-toggle" class="text-gray-700 focus:outline-none text-3xl">☰</button>
        </div>

        <!-- Desktop Navigation -->
        <nav id="menu" class="hidden md:flex md:items-center space-x-6 font-bold mr-0 lg:mr-[100px] md:mr-[50px] sm:mr-0">
            <!-- Added right margin on desktop, removed on md & sm -->
            <a href="./index.php" class="text-gray-700 hover:text-blue-700">Home</a>
            <a href="./form.php" class="text-gray-700 hover:text-blue-700">Cases Details</a>
            <a href="./tumor_coll.php" class="text-gray-700 hover:text-blue-700">Tumor Collections</a>
            <a href="./aboutus.php" class="text-gray-700 hover:text-blue-700">About Us</a>
            <a href="./contactus.php" class="text-gray-700 hover:text-blue-700">Contact Us</a>

            <!-- Profile Section -->
            <div class="relative flex items-center space-x-2">
                <?php if (isset($_SESSION['admin'])) { ?>
                    <span class="text-gray-700 font-bold"><?php echo $_SESSION['admin']; ?></span>
                <?php } ?>
                <button id="profile-button-desktop" class="focus:outline-none relative">
                    <img src="./assets/img/unkonw.jpg" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-500">
                </button>

                <!-- Desktop Profile Dropdown -->
                <div id="dropdown-menu-desktop" class="hidden absolute top-full right-0 mt-2 w-[170px] bg-white shadow-md rounded-md border z-50">
                    <?php if (isset($_SESSION['admin'])) { ?>
                        <a href="logout.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
                        <a href="./changepassword.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Change password</a>
                    <?php } else { ?>
                        <a href="Admin_login.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Login</a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </header>

    <!-- Mobile Menu Dropdown -->
    <div id="mobile-menu" class="hidden flex flex-col items-center bg-white shadow-md w-full md:hidden font-bold">
        <a href="./index.php" class="py-2 text-gray-700 hover:text-blue-700">Home</a>
        <a href="./form.php" class="py-2 text-gray-700 hover:text-blue-700">Cases Details</a>
        <a href="./tumor_coll.php" class="py-2 text-gray-700 hover:text-blue-700">Tumor Collections</a>
        <a href="./aboutus.php" class="py-2 text-gray-700 hover:text-blue-700">About Us</a>
        <a href="./contactus.php" class="py-2 text-gray-700 hover:text-blue-700">Contact Us</a>
    </div>

    <!-- JavaScript for Dropdown and Toggle -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuToggle = document.getElementById("menu-toggle");
            const mobileMenu = document.getElementById("mobile-menu");

            const profileButtonDesktop = document.getElementById("profile-button-desktop");
            const dropdownMenuDesktop = document.getElementById("dropdown-menu-desktop");

            const profileButtonMobile = document.getElementById("profile-button-mobile");
            const dropdownMenuMobile = document.getElementById("dropdown-menu-mobile");

            // Toggle Mobile Menu
            menuToggle.addEventListener("click", function(event) {
                event.stopPropagation(); // Prevent event bubbling
                mobileMenu.classList.toggle("hidden");
            });

            // Toggle Profile Dropdown (Desktop)
            profileButtonDesktop.addEventListener("click", function(event) {
                event.stopPropagation();
                dropdownMenuDesktop.classList.toggle("hidden");
            });

            // Toggle Profile Dropdown (Mobile)
            profileButtonMobile.addEventListener("click", function(event) {
                event.stopPropagation();
                dropdownMenuMobile.classList.toggle("hidden");
            });

            // Close menus when clicking outside
            document.addEventListener("click", function(event) {
                if (!menuToggle.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add("hidden");
                }
                if (!profileButtonDesktop.contains(event.target) && !dropdownMenuDesktop.contains(event.target)) {
                    dropdownMenuDesktop.classList.add("hidden");
                }
                if (!profileButtonMobile.contains(event.target) && !dropdownMenuMobile.contains(event.target)) {
                    dropdownMenuMobile.classList.add("hidden");
                }
            });
        });
    </script>
</body>

</html>
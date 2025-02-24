<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // If using Composer
// require './PHPMailer/src/PHPMailer.php';  // If manually installed
// require './PHPMailer/src/SMTP.php';
// require './PHPMailer/src/Exception.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Change this to your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'kartik932839@gmail.com'; // Your email
        $mail->Password = 'txuqbktetlvzbzxk'; // Use an App Password for Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Content
        $mail->setFrom($email, $name);
        $mail->addAddress('kartik932839@gmail.com'); // Change to your team email
        $mail->Subject = "New Contact Form Submission: $subject";
        $mail->isHTML(true);
        $mail->Body = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();
        echo "<script>alert('Message sent successfully!'); window.location.href='contactus.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error: {$mail->ErrorInfo}');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - OncoLogix</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-[#E3ECF8] to-[#FFFFFF] text-gray-800 flex flex-col min-h-screen">

    <!-- Contact Us Section -->
    <div class="text-center mt-16 px-6">
        <h1 class="text-3xl font-bold text-blue-800">Get in Touch with OncoLogix</h1>
        <p class="mt-5 text-lg max-w-2xl mx-auto leading-relaxed">
            Have any queries or need assistance? Reach out to us via the contact form below.
        </p>
    </div>

    <!-- Contact Section -->
    <section class="mt-10 max-w-2xl mx-auto space-y-6">
        <!-- Contact Details Card -->
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-bold text-blue-700">Our Contact Details</h3>
            <p class="mt-4 text-gray-700"><strong>Email:</strong> support@oncologix.com</p>
            <p class="mt-2 text-gray-700"><strong>Phone:</strong> +1 (800) 123-4567</p>
        </div>

        <!-- Contact Form Card -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold text-blue-700 mb-4 text-center">Send Us a Message</h3>
            <form action="contactus.php" method="POST">
                <!-- First Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-gray-700">Full Name:</label>
                        <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded-md mt-1" required>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700">Email Address:</label>
                        <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded-md mt-1" required>
                    </div>
                </div>

                <!-- Second Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block font-semibold text-gray-700">Phone Number:</label>
                        <input type="tel" name="phone" class="w-full p-2 border border-gray-300 rounded-md mt-1" required>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700">Subject:</label>
                        <input type="text" name="subject" class="w-full p-2 border border-gray-300 rounded-md mt-1" required>
                    </div>
                </div>

                <!-- Message Field (Full Width) -->
                <div class="mt-4">
                    <label class="block font-semibold text-gray-700">Your Message:</label>
                    <textarea name="message" rows="4" class="w-full p-2 border border-gray-300 rounded-md mt-1" required></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-700 text-white font-semibold py-2 rounded-md hover:bg-blue-800 mt-4 transition duration-200">
                    Send Message
                </button>
            </form>
        </div>
    </section>
</body>

</html>
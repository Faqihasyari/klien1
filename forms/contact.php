<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Pastikan path sesuai dengan lokasi autoload.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ganti dengan SMTP provider Anda
        $mail->SMTPAuth = true;
        $mail->Username = 'faqih8158@gmail.com'; // Ganti dengan email Anda
        $mail->Password = 'ggcp jqxi suqh tkzm';   // Gunakan App Password, bukan password biasa
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Pengaturan email
        $mail->setFrom($email, $name);
        $mail->addAddress('contact@example.com'); // Ganti dengan email penerima
        $mail->Subject = $subject;
        $mail->Body = "Nama: $name\nEmail: $email\n\nPesan:\n$message";

        // Kirim email
        if ($mail->send()) {
            echo "success"; // Bisa diganti dengan JSON response
        } else {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    echo "Invalid request method!";
}
?>

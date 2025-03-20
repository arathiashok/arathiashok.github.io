<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_var(trim($_POST["Name"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["Email"]), FILTER_SANITIZE_EMAIL);
    $subject = filter_var(trim($_POST["Subject"]), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST["Message"]), FILTER_SANITIZE_STRING);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    $to = "arathi.ashokpillai@gmail.com";
    $email_subject = "Contact Form: " . $subject;
    $email_body = "You have received a new message from your website contact form.\n\n" .
                  "Name: $name\n" .
                  "Email: $email\n" .
                  "Subject: $subject\n\n" .
                  "Message:\n$message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Error sending message. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $phone = htmlspecialchars(trim($_POST["phone"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));
    $entry = "Phone: $phone\nEmail: $email\nMessage: $message\n---\n";

    $file = "messages.txt";

    file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);

    header("Location: thank-you.html");
    exit;
}
?>
    
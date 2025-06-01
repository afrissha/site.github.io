<?php
// Включаем буферизацию вывода, чтобы избежать ошибок с header()
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Проверяем, что поля существуют
    $phone = isset($_POST["phone"]) ? trim($_POST["phone"]) : '';
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $message = isset($_POST["message"]) ? trim($_POST["message"]) : '';

    // Очищаем данные
    $phone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    // Готовим строку для записи
    $entry = "Phone: $phone\nEmail: $email\nMessage: $message\n---\n";

    // Указываем файл
    $file = __DIR__ . "/messages.txt";

    // Пытаемся записать данные
    if (file_put_contents($file, $entry, FILE_APPEND | LOCK_EX) === false) {
        // Если ошибка, можно залогировать или показать пользователю сообщение
        die("Ошибка при записи данных в файл.");
    }

    // Перенаправляем на страницу благодарности
    header("Location: thank-you.html");
    exit;
}

// Закрываем буфер
ob_end_flush();
?>

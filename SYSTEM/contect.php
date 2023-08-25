<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Get the sender's IP address from the browser session data
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }

    // Set your Telegram bot API token and channel/chat ID
    $apiToken = '6585022523:AAGcW0gB3kCtLjiyiKiyPOR_dr3CPboJ6cY    ';
    $chatId = ' 1815466190 ';

    // Construct the message
    $telegramMessage = "Mahendra\n\nName: $name\nEmail: $email\nMessage: $message\nIP Address: $ipAddress";

    // URL for sending message via Telegram bot API
    $telegramApiUrl = "https://api.telegram.org/bot$apiToken/sendMessage";
    
    // Data to be sent in the POST request
    $postData = array(
        'chat_id' => $chatId,
        'text' => $telegramMessage
    );

    // Initialize cURL session
    $ch = curl_init($telegramApiUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and store response
    $response = curl_exec($ch);

    // Close cURL session
    curl_close($ch);

    if ($response === false) {
        echo "Error sending message ";
    } else {
        echo "Message sent to successfully!";
    }
}
?>
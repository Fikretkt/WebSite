<?php
// Oturum zaten açıksa tekrar başlatma
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Güvenlik Notu: Bu API key'i GitHub Secrets veya environment variable'dan almak daha güvenlidir.
$apiKey = "";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_SESSION['chat_history'])) $_SESSION['chat_history'] = [];

    if (isset($_POST['action']) && $_POST['action'] == 'clear') {
        $_SESSION['chat_history'] = [];
        echo json_encode(['status' => 'cleared']);
        exit;
    }

    $userQuestion = trim($_POST['question']);

    if (!empty($userQuestion)) {
        $userPart = ["text" => $userQuestion];

        // Dosya Yükleme
        if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
            $fileData = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
            $fileType = $_FILES['file']['type'];
            $userPart = [
                "text" => $userQuestion,
                "inline_data" => ["mime_type" => $fileType, "data" => $fileData]
            ];
        }

        $currentMessage = ["role" => "user", "parts" => isset($userPart['inline_data']) ? [["text" => $userQuestion], ["inline_data" => $userPart['inline_data']]] : [["text" => $userQuestion]]];

        // Geçmişi Hazırla
        $messagesToSend = [];
        foreach ($_SESSION['chat_history'] as $hist) {
            if (isset($hist['parts'][0]['text'])) {
                $messagesToSend[] = ["role" => $hist['role'], "parts" => [["text" => $hist['parts'][0]['text']]]];
            }
        }
        $messagesToSend[] = $currentMessage;

        // API İsteği
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $apiKey;
        $data = ["contents" => $messagesToSend];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            $decoded = json_decode($response, true);
            if (isset($decoded['candidates'][0]['content']['parts'][0]['text'])) {
                $aiReply = $decoded['candidates'][0]['content']['parts'][0]['text'];

                $_SESSION['chat_history'][] = ["role" => "user", "parts" => [["text" => $userQuestion]]];
                $_SESSION['chat_history'][] = ["role" => "model", "parts" => [["text" => $aiReply]]];

                echo json_encode(['status' => 'success', 'reply' => $aiReply]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'API cevabı işlenemedi.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'API Hatası veya Kota Doldu.']);
        }
    } else {
        echo json_encode(['status' => 'empty']);
    }
}
?>

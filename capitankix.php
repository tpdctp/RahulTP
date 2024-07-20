<?php
header('Content-Type: application/json');

// Your name and Telegram channel link
$myName = "Telegram-Live-Cric-Hd";
$telegramChannel = "https://telegram.me/livecrichdofficial";

// Fetch JSON data from the URL
$jsonUrl = "https://toxicify-tpkeys.vercel.app/data/tplay.json";
$jsonData = file_get_contents($jsonUrl);
$data = json_decode($jsonData, true);

// Get the id from the query parameter
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    $found = false;
    foreach ($data as $item) {
        if ($item['id'] == $id) {
            if (isset($item['hex_keys'][0])) {
                list($keyid, $key) = explode(':', $item['hex_keys'][0]);
                
                // Prepare the response
                $response = [
                    'name' => $myName,
                    'telegram_channel' => $telegramChannel,
                    'id' => $item['id'],
                    'keyid' => $keyid,
                    'key' => $key
                ];
                
                echo json_encode($response, JSON_PRETTY_PRINT);
            } else {
                // If hex_keys are not found
                echo json_encode([
                    'name' => $myName,
                    'telegram_channel' => $telegramChannel,
                    'error' => 'No hex_keys found for this ID'
                ], JSON_PRETTY_PRINT);
            }
            $found = true;
            break;
        }
    }
    
    if (!$found) {
        // If ID is not found
        echo json_encode([
            'name' => $myName,
            'telegram_channel' => $telegramChannel,
            'error' => 'ID not found'
        ], JSON_PRETTY_PRINT);
    }
} else {
    // If ID parameter is not provided
    echo json_encode([
        'name' => $myName,
        'telegram_channel' => $telegramChannel,
        'error' => 'ID parameter is required'
    ], JSON_PRETTY_PRINT);
}
?>


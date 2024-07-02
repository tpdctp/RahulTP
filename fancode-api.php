<?php
// Function to get the value of a specific header
function getHeader($headerName) {
    foreach (getallheaders() as $name => $value) {
        if (strcasecmp($name, $headerName) == 0) {
            return $value;
        }
    }
    return null;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

// Check for the presence of specific headers
$requiredHeader1 = getHeader('X-Special-Header-1');
$requiredHeader2 = getHeader('X-Special-Header-2');

if ($requiredHeader1 !== 'expected_value_1' || $requiredHeader2 !== 'expected_value_2') {
    echo json_encode(['error' => 'Missing or invalid headers']);
    exit;
}

// URL to fetch JSON data
$url = 'https://raw.githubusercontent.com/byte-capsule/FanCode-Hls-Fetcher/main/Fancode_hls_m3u8.Json';

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: PHP Fetcher',
    'X-Origin: @Livecrichdofficial by @Capitanmatrix'
]);

// Execute cURL session
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
    curl_close($ch);
    exit;
}

// Close cURL session
curl_close($ch);

// Decode JSON response
$data = json_decode($response, true);

// Check if JSON decoding was successful
if ($data === null) {
    echo 'Error decoding JSON';
    exit;
}

// Prepare an array to hold formatted data
$formattedData = [];

// Iterate through each channel
foreach ($data['channels'] as $channel) {
    // Check if the key exists in the array before accessing it
    $event_category = isset($channel['event_catagory']) ? $channel['event_catagory'] : null;

    // Format data for output
    $formattedData[] = [
        'event_category' => $event_category, // Use 'event_catagory' if that's the actual key
        'event_name' => $channel['event_name'],
        'match_id' => $channel['match_id'],
        'match_name' => $channel['match_name'],
        'team_1' => $channel['team_1'],
        'team_1_flag' => $channel['team_1_flag'],
        'team_2' => $channel['team_2'],
        'team_2_flag' => $channel['team_2_flag'],
        'stream_link' => $channel['stream_link']
    ];
}

// Additional information
$additionalInfo = [
    'channel_name' => 'LiveCricHd Fancode Php',
    'channel_link' => 'https://telegram.me/livecrichdofficial',
    'thanks_to' => 'Thanks to byte capsule'
];

// Combine formatted data with additional information
$output = [
    'channel_info' => $additionalInfo,
    'matches' => $formattedData
];

// Output the combined data as JSON
header('Content-Type: application/json');
echo json_encode($output, JSON_PRETTY_PRINT);
?>

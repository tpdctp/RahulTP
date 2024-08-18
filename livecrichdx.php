<?php
header('Content-Type: application/json');

// Check if 'id' is provided in the URL
if (!isset($_GET['id'])) {
    echo json_encode(["error" => "Please provide a valid ID."]);
    exit;
}

// Get the ID from the URL
$id = $_GET['id'];

// Construct the URL to fetch the data
$url = "https://fox.toxic-gang.xyz/tata/key/$id";

// Fetch the data from the API
$response = file_get_contents($url);

// Check if the response is valid
if ($response === FALSE) {
    echo json_encode(["error" => "Failed to fetch data from the API."]);
    exit;
}

// Decode the JSON response
$data = json_decode($response, true);

// Check if the data contains 'licence1' and 'licence2'
if (isset($data['data']['licence1']) && isset($data['data']['licence2'])) {
    // Extract 'licence1' and 'licence2' and return them as JSON
    echo json_encode([
        "licence1" => $data['data']['licence1'],
        "licence2" => $data['data']['licence2']
    ]);
} else {
    echo json_encode(["error" => "Licence data not found."]);
}
?>

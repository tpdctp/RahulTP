<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Match Streams</title>
    <style>
        body {
            background-color: #f4e9d7; /* Light brown background */
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
        }

        h1 {
            color: #6b3e1e; /* Dark brown text color */
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px; /* Adjust the top margin */
        }

        .join-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .join-button {
            background-color: #4d260b; /* Darker brown background for button */
            color: #fff; /* White text color */
            text-align: center;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            cursor: pointer;
            text-decoration: none; /* Remove underline from link */
            transition: background-color 0.3s ease;
            font-weight: bold;
            margin-top: -10px; /* Adjust to move button up */
        }

        .join-button:hover {
            background-color: #6b3e1e; /* Dark brown on hover */
        }

        .match-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Adjust space between match boxes */
            justify-content: center; /* Center align match boxes */
        }

        .match {
            background-color: #fff; /* White background for match boxes */
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 300px; /* Fixed width for match boxes */
        }

        .match:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .event-name {
            background-color: #6b3e1e; /* Dark brown background for event name box */
            color: #fff; /* White text color */
            text-align: center;
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 10px; /* Adjust space between event name box and match box */
            width: 100%;
            text-transform: uppercase; /* Capitalize event name */
            font-size: 12px; /* Font size for event name */
        }

        .event-name small {
            display: block;
            font-size: 10px;
            font-weight: normal;
            margin-top: 5px;
        }

        .team {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .team img {
            width: 30px; /* Adjust logo size */
            height: auto;
            margin-right: 10px;
        }

        .team span {
            font-size: 14px; /* Adjust team name font size */
            font-weight: bold; /* Make team names bold */
            white-space: nowrap; /* Prevent team names from wrapping */
            font-family: 'Arial Black', sans-serif; /* Different font for team names */
        }

        .vs {
            margin: 10px 0;
            font-weight: bold;
            font-size: 16px; /* Adjust font size of 'vs' */
        }

        .video-container {
            display: none;
            margin-top: 20px;
        }

        video {
            width: 100%;
            height: auto;
        }

        @media screen and (max-width: 600px) {
            .match {
                width: calc(100% - 20px); /* Full width with gap */
            }
        }
    </style>
</head>
<body>
    <h1>LiveCricHd FanCode</h1>
    <div class="join-container">
        <a href="https://t.me/livecrichdofficial" target="_blank" class="join-button">JOIN TELEGRAM - @LIVECRICHDOFFICIAL</a>
    </div>
    <div class="match-container" id="matches">
        <?php
        // PHP code to fetch data
        $url = 'https://proxy.animebash.workers.dev/?u=https://livecrichdofficial.000webhostapp.com/fetch_data.php';
        $headers = [
            'HTTP_DHruv_Capitan_Header_1: expected_value_1',
            'HTTP_DHruv_Capitan_Header_2: expected_value_2'
        ];

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true); // Use POST method

        // Execute cURL session
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            echo '<p>Error: ' . curl_error($ch) . '</p>';
            curl_close($ch);
            exit;
        }

        // Close cURL session
        curl_close($ch);

        // Decode JSON response
        $data = json_decode($response, true);

        // Check if JSON decoding was successful
        if ($data === null) {
            echo '<p>Error decoding JSON</p>';
            exit;
        }

        // Iterate through each channel
        foreach ($data['channels'] as $channel) {
            // Format data for output
            echo '<div class="match" onclick="redirectToPlayer(\'' . $channel['stream_link'] . '\')">';
            echo '<div class="event-name">' . $channel['event_name'] . '</div>';
            echo '<div class="team">';
            echo '<img src="' . $channel['team_1_flag'] . '" alt="' . $channel['team_1'] . ' Flag">';
            echo '<span>' . $channel['team_1'] . '</span>';
            echo '</div>';
            echo '<div class="vs">Vs</div>';
            echo '<div class="team">';
            echo '<img src="' . $channel['team_2_flag'] . '" alt="' . $channel['team_2'] . ' Flag">';
            echo '<span>' . $channel['team_2'] . '</span>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <div id="video-container" class="video-container">
        <video id="video-player" controls>
            Your browser does not support the video tag.
        </video>
    </div>

    <script>
        function redirectToPlayer(streamLink) {
            const videoUrl = `https://livecrichdm3u8player.pages.dev/?dtv=${encodeURIComponent(streamLink)}`;
            window.location.href = videoUrl;
        }
    </script>
</body>
</html>

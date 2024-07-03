<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LiveCricHd Fancode</title>
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
        // Fetch match data from fetch_data.php
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://livecrichdofficial.000webhostapp.com/fetch_data.php'); // Replace with your actual URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: Caption Player xyz123',
            'Authorization: Bearer Token xyz'
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            $data = json_decode($response, true);

            if ($data) {
                foreach ($data['matches'] as $match) {
                    echo '<div class="match" onclick="redirectToPlayer(\'' . $match['stream_link'] . '\')">';
                    echo '<div class="event-name">' . htmlspecialchars($match['event_name']) . '</div>';
                    echo '<div class="team"><img src="' . htmlspecialchars($match['team_1_flag']) . '" alt="' . htmlspecialchars($match['team_1']) . ' Flag"><span>' . htmlspecialchars($match['team_1']) . '</span></div>';
                    echo '<div class="vs">Vs</div>';
                    echo '<div class="team"><img src="' . htmlspecialchars($match['team_2_flag']) . '" alt="' . htmlspecialchars($match['team_2']) . ' Flag"><span>' . htmlspecialchars($match['team_2']) . '</span></div>';
                    echo '</div>';
                }
            } else {
                echo 'Error decoding JSON';
            }
        } else {
            echo 'Error fetching data';
        }
        ?>
    </div>

    <script>
        function redirectToPlayer(streamLink) {
            const videoUrl = `https://livecrichdm3u8player.pages.dev/?dtv=${encodeURIComponent(streamLink)}`;
            window.location.href = videoUrl;
        }
    </script>
</body>
</html>

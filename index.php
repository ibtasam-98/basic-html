<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Namaz Prayer Timings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #2c3e50, #27ae60);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        main {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 20px;
        }

        section {
            margin-bottom: 12px;
            padding: 8px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }

        strong {
            color: #2c3e50;
        }

        p {
            color: red;
        }
    </style>
</head>
<body>

<main>
    <h1>Prayer Timings for Islamabad</h1>

    <?php
        $date = date("d-m-Y");
        $url = "https://api.aladhan.com/v1/timingsByCity/$date?city=Islamabad&country=Pakistan&method=2";

        $response = @file_get_contents($url);

        if ($response === FALSE) {
            echo "<p>Unable to fetch prayer timings. Please try again later.</p>";
        } else {

            $data = json_decode($response, true);

            if (isset($data['data']['timings'])) {

                $timings = $data['data']['timings'];

                $prayerNames = [
                    'Fajr',
                    'Sunrise',
                    'Dhuhr',
                    'Asr',
                    'Maghrib',
                    'Isha'
                ];

                foreach ($prayerNames as $name) {
                    echo "<section>";
                    echo "<strong>$name</strong>";
                    echo "<span>" . $timings[$name] . "</span>";
                    echo "</section>";
                }

            } else {
                echo "<p>Invalid response from API.</p>";
            }
        }
    ?>

</main>

</body>
</html>

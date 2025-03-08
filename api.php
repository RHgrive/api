<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
</head>
<body>
    <h1>API Request</h1>
    <form method="post" action="">
        <label for="hex">Hex:</label>
        <input type="text" id="hex" name="hex" required><br>

        <label for="arch">Arch:</label>
        <input type="text" id="arch" name="arch" required><br>

        <label for="offset">Offset:</label>
        <input type="text" id="offset" name="offset"><br>

        <button type="submit">Send</button>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $url = 'https://armconverter.com/api/convert';

            $data = [
                'hex' => $_POST['hex'],
                'arch' => $_POST['arch'],
                'offset' => $_POST['offset']
            ];

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            } else {
                echo '<h2>Response</h2>';
                echo '<pre>';
                print_r(json_decode($response, true));
                echo '</pre>';
            }

            curl_close($ch);
        }
    ?>
</body>
</html>

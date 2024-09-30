<?php

// Koneksi ke database
$mysqli = new mysqli("127.0.0.1", "root", "", "gpshistory");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "SELECT latitude AS lat, longitude AS lng FROM history ORDER BY ID DESC";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $rows = $result->fetch_all();
    $result = [];

    foreach ($rows as $key => $value) {
        $result[] = [
            "latitude" => $value[0],
            "longitude" => $value[1]
        ];
    }

    echo json_encode([
        "data" => $result
    ]);

} else {
    echo json_encode([
        'latitude' => 0,
        'longitude' => 0
    ]);
}

$mysqli->close();
?>

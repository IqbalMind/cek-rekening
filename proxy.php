<?php
header("Content-Type: application/json");

// Dapatkan URL dari parameter 'url' yang dikirim oleh jQuery AJAX
if (isset($_GET['url'])) {
    $url = $_GET['url'];

    // Inisiasi cURL untuk mengambil data dari API eksternal
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Eksekusi permintaan dan dapatkan respons
    $response = curl_exec($ch);
    curl_close($ch);

    // Tampilkan respons dari API eksternal
    echo $response;
} else {
    echo json_encode(["status" => false, "msg" => "URL tidak ditemukan"]);
}

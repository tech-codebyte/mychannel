<?php
$url = $_GET['url'] ?? '';
if (!$url || !filter_var($url, FILTER_VALIDATE_URL)) {
    http_response_code(400);
    exit('Invalid URL');
}

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
    CURLOPT_HTTPHEADER => [
        'Accept: image/avif,image/webp,image/apng,image/*,*/*;q=0.8',
        'Referer: https://s.h5games.online/'
    ]
]);
$data = curl_exec($ch);
$mime = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

header("Content-Type: $mime");
echo $data;

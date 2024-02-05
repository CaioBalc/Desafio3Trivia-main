<?php

$URI = "?amount=1";

# Inicializa o cURL
$ch = curl_init();

# Configura a URL (endpoint da API do Open Trivia Database)
curl_setopt($ch, CURLOPT_URL, "https://opentdb.com/api.php{$URI}");

# Configura a opção para retornar a resposta como uma string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

# Executa a requisição
$response = curl_exec($ch);

# Em caso de erro da chamada, ele é tratado
if (curl_errno($ch)) {
    http_response_code(400);
    echo json_encode(['message' => 'Curl error: ' . curl_error($ch)]);
    exit;
}

# Fecha o cURL
curl_close($ch);

# Decodifica a resposta JSON
$data = json_decode($response, true);

print_r($response);
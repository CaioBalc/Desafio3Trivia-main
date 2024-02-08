<?php

class GeradorToken {
    public function geraNovoToken() {
        $url = "https://opentdb.com/api_token.php?command=request";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        

        // Verifica se a chamada foi bem-sucedida e se há um token na resposta
        if (!empty($data) && $data['response_code'] == 0 && isset($data['token'])) {
            // Retorna apenas o token sem imprimir nada
            return $data['token'];
        } else {
            // Retorna um código de erro específico ou genérico se a resposta não for bem-sucedida
            //$errorCode = isset($data['response_code']) ? $data['response_code'] : 'Erro desconhecido';
            //echo "Código de erro: $errorCode\n";
            return null;
        }
    }
}

/* Uso
$tokenGenerator = new TriviaSessionTokenGenerator();
$sessionToken = $tokenGenerator->geraNovoToken();*/



    
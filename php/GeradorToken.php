<?php

class GeradorToken {
    public function geraNovoToken() {
        $url = "https://opentdb.com/api_token.php?command=request";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        

       
        if (!empty($data) && $data['response_code'] == 0 && isset($data['token'])) {
            
            return $data['token'];
        } else {
            //$errorCode = isset($data['response_code']) ? $data['response_code'] : 'Erro desconhecido';
            //echo "Código de erro: $errorCode\n";
            return null;
        }
    }
}




    
<?php

//funcionando com pdo ok eu acho 
//pega uma pergunta da api e salva no banco de dados 

//falta: se codigo de erro5 esperar 5 segundos e tentar de novo

require_once 'Conexao.php'; 

class TriviaAPIParaBanco {
    private $dbConnection;
    private $Token;
    private $debug = false;

    public function __construct($sessionToken) {
        $this->Token = $sessionToken;
        $this->dbConnection = Conexao::conectar(); // Utiliza a conexão única fornecida pela classe Conexao
    }

    public function fetchAndSaveQuestion() 
    {
        $tentativas = 0;
        do{
            $tentativas++;
            $uri = "?amount=1";
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, "https://opentdb.com/api.php" . $uri . "&token=" . $this->Token);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);

            if (curl_errno($ch)) 
            {
                echo'Erro ao buscar dados da API: ' . curl_error($ch) . "\n";//testar
                curl_close($ch);
                
                return false;//falha 1 --------------------
                
            }
            curl_close($ch);
            $data = json_decode($response, true);

            // Imprimindo a resposta da API no terminal
            if($this->debug == true)
            {
                echo "Resposta da API: \n";
                print_r($data);
            }

            if ($data && $data['response_code'] == 0) 
            {
                foreach ($data['results'] as $result) {
                    $this->saveQuestion($result);
                    return true; //sucesso-------------------------------
                }
            } else {

                $codigo = $data['response_code'];
                if($this->debug == true)
                {
                    echo "Resposta da API inválida (Código de Resposta: {$codigo}). Tentando novamente em 5 segundos...\n";
                }
                sleep(5);

            }
        } while ($tentativas < 3);
        if($this->debug == true)
        {
            echo "Excedeu o limite de tentativas. Mudando para modo offline.\n";
        }
       
        return false;// falha 2 ------------
    }

    private function saveQuestion($questionData) {//função usada dentro da de cima para pegar os dados do json e salvar no formato certo na tabela
        $sql = "INSERT INTO perguntas (tipo, categoria, dificuldade, pergunta, respostaCorreta, respostasIncorretas) VALUES (?, ?, ?, ?, ?, ?)";
        try {
            $stmt = $this->dbConnection->prepare($sql);
            $incorrectAnswers = implode(', ', $questionData['incorrect_answers']);
            $stmt->execute([
                $questionData['type'],
                $questionData['category'],
                $questionData['difficulty'],
                $questionData['question'],
                $questionData['correct_answer'],
                $incorrectAnswers
            ]);
            if($this->debug == true)
            {
                echo "Pergunta salva com sucesso.\n";
            }
        } catch (PDOException $e) {
            exit('Erro ao salvar pergunta no banco de dados: ' . $e->getMessage());
        }
    }
}

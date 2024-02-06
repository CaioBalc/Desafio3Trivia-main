<?php
//pega uma pergunta da api e salva no banco de dados

class TriviaAPIParaBanco {
    private $dbConnection;
    private $Token;

    public function __construct($dsn, $user, $password, $sessionToken) {
        $this->Token = $sessionToken;
        try {
            $this->dbConnection = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            echo "Conexão com o banco de dados estabelecida.\n";
        } catch (PDOException $e) {
            exit('Erro ao conectar com o banco de dados: ' . $e->getMessage());
        }
    }

    public function fetchAndSaveQuestion() {
        $uri = "?amount=1";
        $ch = curl_init();
        //dar print no Token e checar se esta no formato certo para requisição
        curl_setopt($ch, CURLOPT_URL, "https://opentdb.com/api.php" . $uri . "&token=" . $this->Token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            curl_close($ch);
            exit('Erro ao buscar dados da API: ' . curl_error($ch));
        }
        curl_close($ch);
        $data = json_decode($response, true);

        // Imprimindo a resposta da API no terminal
        echo "Resposta da API: \n";
        print_r($data);

        if ($data && $data['response_code'] == 0) {
            foreach ($data['results'] as $result) {
                $this->saveQuestion($result);
            }
        } else {
            exit('Resposta da API inválida ou sem dados.');
        }
    }

    private function saveQuestion($questionData) {
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
            echo "Pergunta salva com sucesso.\n";
        } catch (PDOException $e) {
            exit('Erro ao salvar pergunta no banco de dados: ' . $e->getMessage());
        }
    }
}

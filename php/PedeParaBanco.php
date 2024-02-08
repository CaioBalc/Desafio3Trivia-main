<?php

require_once 'Conexao.php'; // Certifique-se de que o caminho esteja correto

class PedeParaBanco {
    private $pdo;
    private $usarUltimaPergunta;
    private $perguntaAtual;

    public function __construct($usarUltimaPergunta = true) {
        $this->pdo = Conexao::conectar(); // Utiliza a classe Conexao para obter a conexão
        $this->usarUltimaPergunta = $usarUltimaPergunta;
        $this->selecionaPergunta();
    }

    private function selecionaPergunta() {
        if ($this->usarUltimaPergunta) {
            $sql = "SELECT * FROM perguntas ORDER BY idpergunta DESC LIMIT 1";
        } else {
            $sql = "SELECT * FROM perguntas ORDER BY RANDOM() LIMIT 1";
        }

        $stmt = $this->pdo->query($sql);
        $this->perguntaAtual = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function pegaPergunta() {
        return $this->perguntaAtual['pergunta'] ?? null;
    }

    public function pegaDificuldade() {
        return $this->perguntaAtual['dificuldade'] ?? null;
    }

    public function pegaRespostaCorreta() {
        return $this->perguntaAtual['respostacorreta'] ?? null;
    }

    public function pegaRespostasErradas() {
        // Se as respostas erradas forem armazenadas como uma string, você pode querer convertê-las em um array
        // Supondo que as respostas erradas são separadas por vírgula
        return isset($this->perguntaAtual['respostasincorretas']) ? explode(', ', $this->perguntaAtual['respostasincorretas']) : null;
    }

    public function pegaTipo() {
        return $this->perguntaAtual['tipo'] ?? null;
    }

    public function pegaPerguntaId() {
        return $this->perguntaAtual['idpergunta'] ?? null;
    }
}

<?php

class PedeParaBanco {
    private $pdo;
    private $usarUltimaPergunta;
    private $perguntaAtual;

    public function __construct($pdo, $usarUltimaPergunta = true) {
        $this->pdo = $pdo;
        $this->usarUltimaPergunta = $usarUltimaPergunta;
        $this->selecionaPergunta();
    }

    private function selecionaPergunta() {
        if ($this->usarUltimaPergunta) {
            $sql = "SELECT * FROM perguntas ORDER BY id DESC LIMIT 1";
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
        return $this->perguntaAtual['respostasincorretas'] ?? null;
    }

    public function pegaTipo() {
        return $this->perguntaAtual['tipo'] ?? null;
    }
}

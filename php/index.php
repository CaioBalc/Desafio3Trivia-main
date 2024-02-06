<?php

require_once 'Conexao.php';
require_once 'TriviaAPIParaBanco.php';
require_once 'PedeParaBanco.php';
require_once 'GeradorToken.php';

// A classe TriviaAPIParaBanco será ajustada para usar a classe Conexao internamente
$tokenGenerator = new GeradorToken();
$sessionToken = $tokenGenerator->geraNovoToken();

$triviaAPIParaBanco = new TriviaAPIParaBanco($sessionToken);
$triviaAPIParaBanco->fetchAndSaveQuestion();


// Utiliza false para pergunta aleatória ou true para a última pergunta
$buscaPergunta = new PedeParaBanco(false); // Passando false para exemplo de pergunta aleatória

echo "Pergunta: " . $buscaPergunta->pegaPergunta() . "\n";
echo "Dificuldade: " . $buscaPergunta->pegaDificuldade() . "\n";
echo "Resposta Correta: " . $buscaPergunta->pegaRespostaCorreta() . "\n";
echo "Respostas Erradas: " . implode(", ", $buscaPergunta->pegaRespostasErradas()) . "\n"; // Use implode para juntar as respostas erradas, se elas forem um array
echo "Tipo: " . $buscaPergunta->pegaTipo() . "\n";

// botao retornar numero de 1 a 4 para testar se acertou


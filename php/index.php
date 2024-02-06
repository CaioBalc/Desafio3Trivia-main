<?php

require_once 'Conexao.php';
require_once 'TriviaAPIParaBanco.php';
require_once 'PedeParaBanco.php';
require_once 'GeradorToken.php';

//prontas
//triviaAPIParaBanco --falta adaptar para retornar true ou false para a pede banco
//GeradorToken
//PedeParaBanco

// A classe TriviaAPIParaBanco será ajustada para usar a classe Conexao internamente
$tokenGenerator = new GeradorToken();
$sessionToken = $tokenGenerator->geraNovoToken();

$triviaAPIParaBanco = new TriviaAPIParaBanco($sessionToken);
$triviaAPIParaBanco->fetchAndSaveQuestion();


// Utiliza false para pergunta aleatória ou true para a última pergunta
$PerguntaEscolhida = new PedeParaBanco(false); // Passando false para exemplo de pergunta aleatória se tiver offline
$pergunta = $PerguntaEscolhida->pegaPergunta();

print_r($pergunta);

echo"\n\n";

/*echo "Pergunta: " . $buscaPergunta->pegaPergunta() . "\n";
echo "Dificuldade: " . $buscaPergunta->pegaDificuldade() . "\n";
echo "Resposta Correta: " . $buscaPergunta->pegaRespostaCorreta() . "\n";
echo "Respostas Erradas: " . implode(", ", $buscaPergunta->pegaRespostasErradas()) . "\n"; // Use implode para juntar as respostas erradas, se elas forem um array
echo "Tipo: " . $buscaPergunta->pegaTipo() . "\n";*/

// botao retornar numero de 1 a 4 para testar se acertou

?>
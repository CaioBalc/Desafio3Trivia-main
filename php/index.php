<?php

require_once 'triviaAPIParaBanco.php';
require_once 'GeradorToken.php';

// criar classe conexç~ao que nem no exercicio 2 do 02
$dsn = 'pgsql:host=db;dbname=dadosjogos'; 
$user = 'usuario'; 
$password = 'senha'; 
//adaptar codigo para usar pdo
//$pdo = new PDO('pgsql:host=db;dbname=dadosjogos', 'usuario', 'senha');  

$tokenGenerator = new GeradorToken();
$sessionToken = $tokenGenerator->geraNovoToken();

$triviaAPIParaBanco = new TriviaAPIParaBanco($dsn, $user, $password, $sessionToken);
$triviaAPIParaBanco->fetchAndSaveQuestion();

$pdo = new PDO('pgsql:host=db;dbname=dadosjogos', 'usuario', 'senha');
//$buscaPergunta = new PedeParaBanco($pdo, false); // false para pergunta aleatória true para ultima pergunta online/offline

/*echo "Pergunta: " . $buscaPergunta->pegaPergunta() . "\n";
echo "Dificuldade: " . $buscaPergunta->pegaDificuldade() . "\n";
echo "Resposta Correta: " . $buscaPergunta->pegaRespostaCorreta() . "\n";
echo "Respostas Erradas: " . $buscaPergunta->pegaRespostasErradas() . "\n";
echo "Tipo: " . $buscaPergunta->pegaTipo() . "\n";*/


//cada botao retorna um numero de 1 a 4 que dai ve se 'e o mesmo numero da resposta certa
?>

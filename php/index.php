<?php

require_once 'TriviaAPIParaBanco.php';

$dsn = 'pgsql:host=db;dbname=dadosjogos'; 
$user = 'usuario'; 
$password = 'senha'; 

$tokenGenerator = new GeradorToken();
$sessionToken = $tokenGenerator->geraNovoToken();

$triviaAPIParaBanco = new TriviaAPIParaBanco($dsn, $user, $password, $sessionToken);
$triviaAPIParaBanco->fetchAndSaveQuestion();
?>

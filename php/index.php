<?php

$serverAddress = '0.0.0.0:80';

echo "Iniciando servidor web em http://{$serverAddress}\n";
// Inicia o servidor web embutido
exec("php -S {$serverAddress} " . __FILE__);

session_start();

require_once 'Conexao.php';
require_once 'TriviaAPIParaBanco.php';
require_once 'PedeParaBanco.php';
require_once 'GeradorToken.php';

//prontas
//triviaAPIParaBanco 
//GeradorToken
//PedeParaBanco
//Conexao

// A classe TriviaAPIParaBanco será ajustada para usar a classe Conexao internamente
$tokenGenerator = new GeradorToken();
$sessionToken = $tokenGenerator->geraNovoToken();

$triviaAPIParaBanco = new TriviaAPIParaBanco($sessionToken);
$online =$triviaAPIParaBanco->fetchAndSaveQuestion();


// Utiliza false para pergunta aleatória ou true para a última pergunta
$PerguntaEscolhida = new PedeParaBanco($online); // Passando false para exemplo de pergunta aleatória se tiver offline
$pergunta = $PerguntaEscolhida->pegaPergunta();

$_SESSION['Pergunta'] = $PerguntaEscolhida->pegaPergunta();
$_SESSION['RespostaCorreta'] = $PerguntaEscolhida->pegaRespostaCorreta();
$_SESSION['RespostasIncorretas'] = $PerguntaEscolhida->pegaRespostasErradas();
$_SESSION['Tipo'] = $PerguntaEscolhida->pegaTipo();
$_SESSION['Dificuldade'] = $PerguntaEscolhida->pegaDificuldade();

print_r($pergunta);

echo"\n\n";

/*echo "Pergunta: " . $buscaPergunta->pegaPergunta() . "\n";
echo "Dificuldade: " . $buscaPergunta->pegaDificuldade() . "\n";
echo "Resposta Correta: " . $buscaPergunta->pegaRespostaCorreta() . "\n";
echo "Respostas Erradas: " . implode(", ", $buscaPergunta->pegaRespostasErradas()) . "\n"; // Use implode para juntar as respostas erradas, se elas forem um array
echo "Tipo: " . $buscaPergunta->pegaTipo() . "\n";*/

// pesquisar htmlspecialchars()

require_once 'Pagina.php';// primeiro testar as classes depois debug, depois add ------

?>
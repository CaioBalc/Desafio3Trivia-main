<?php


session_start();

require_once 'Conexao.php';
require_once 'TriviaAPIParaBanco.php';
require_once 'PedeParaBanco.php';
require_once 'GeradorToken.php';



if (!isset($_SESSION['nome_usuario'])) {
    header('Location: PaginaNome.php');
    exit;
}

if (isset($_SESSION['TentativasJogadas']) && $_SESSION['TentativasJogadas'] >= 5) {
    header('Location: PaginaObrigado.php');
    exit;
}



$tokenGenerator = new GeradorToken();
$sessionToken = $tokenGenerator->geraNovoToken();

$triviaAPIParaBanco = new TriviaAPIParaBanco($sessionToken);
$online =$triviaAPIParaBanco->fetchAndSaveQuestion();



$PerguntaEscolhida = new PedeParaBanco($online); 
$pergunta = $PerguntaEscolhida->pegaPergunta();

$_SESSION['Pergunta'] = $PerguntaEscolhida->pegaPergunta();
$_SESSION['RespostaCorreta'] = $PerguntaEscolhida->pegaRespostaCorreta();
$_SESSION['RespostasIncorretas'] = $PerguntaEscolhida->pegaRespostasErradas();
$_SESSION['Tipo'] = $PerguntaEscolhida->pegaTipo();
$_SESSION['Dificuldade'] = $PerguntaEscolhida->pegaDificuldade();
$_SESSION['PerguntaId'] = $PerguntaEscolhida->pegaPerguntaId();




header('Location: PaginaJogo.php');
exit;

?>
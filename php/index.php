<?php


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

//print_r($pergunta);

//echo"\n\n";

// pesquisar htmlspecialchars()

require_once 'PaginaJogo.php';// primeiro testar as classes depois debug, depois add ------


// Se o botão de "Jogar Novamente" foi pressionado, resetar as variáveis de sessão
// Verifica se o usuário já inseriu o nome.
if (!isset($_SESSION['nome_usuario'])) {
    header('Location: PaginaNome.php');
    exit;
}

// Verifica se o usuário completou o jogo.
if (isset($_SESSION['jogos_completados']) && $_SESSION['jogos_completados'] >= 5) {
    header('Location: paginaObrigado.php');
    exit;
}

// Se o usuário já tem um nome, mas não completou 5 jogos, mostra a página do jogo.
header('Location: paginaJogo.php');
exit;

?>
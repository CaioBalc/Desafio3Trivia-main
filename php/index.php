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

print_r($pergunta);

echo"\n\n";

/*echo "Pergunta: " . $buscaPergunta->pegaPergunta() . "\n";
echo "Dificuldade: " . $buscaPergunta->pegaDificuldade() . "\n";
echo "Resposta Correta: " . $buscaPergunta->pegaRespostaCorreta() . "\n";
echo "Respostas Erradas: " . implode(", ", $buscaPergunta->pegaRespostasErradas()) . "\n"; // Use implode para juntar as respostas erradas, se elas forem um array
echo "Tipo: " . $buscaPergunta->pegaTipo() . "\n";*/

// pesquisar htmlspecialchars()

require_once 'PaginaJogo.php';// primeiro testar as classes depois debug, depois add ------

/*
// Se o botão de "Jogar Novamente" foi pressionado, resetar as variáveis de sessão
if (isset($_POST['jogar_novamente'])) {
    unset($_SESSION['nome_usuario']);
    unset($_SESSION['jogos_completados']);
}

// Checa se o usuário já inseriu o nome
if (!isset($_SESSION['nome_usuario'])) {
    require_once 'pagina_nome.php';
    exit;
} elseif (!isset($_SESSION['jogos_completados']) || $_SESSION['jogos_completados'] < 5) {
    // Se o nome está definido, mas o usuário ainda não completou 5 jogos
    require_once 'pagina_jogo.php';
    exit;
} else {
    // Se o usuário já completou 5 jogos
    require_once 'pagina_obrigado.php';
    exit;
*/

?>
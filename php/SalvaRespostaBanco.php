<?php

require_once 'Conexao.php';

session_start();

if (isset($_POST['Resposta'])) 
{
    $dbConnection = Conexao::conectar();

    $resposta = $_POST['Resposta'];

    

    if ($resposta == $_SESSION['RespostaCorreta']) 
    {
        echo 'Correto!';
        $acerto = true;
        $_SESSION['Pontuacao']++;
    } else {
        echo 'Errado!';
        $acerto = false;
    }
    $_SESSION['TentativasJogadas']++;

    $nomeJogador = $_SESSION['nome_usuario'];
    $perguntaId = $_SESSION['PerguntaId']; // Garanta que isso está sendo definido corretamente em outra parte do seu código
    $idJogo = $_SESSION['idJogo'];
    $idJogador = $_SESSION['idJogador'];
    $acertoFormatado = $acerto ? 'true' : 'false'; //talvez resolve

    // Preparando a query SQL para inserir a jogada
    $sql = "INSERT INTO jogadas (idJogo, idJogador, nomeJogador, acerto, idPergunta) VALUES (?, ?, ?, ?, ?)";

    try {
        $stmt = $dbConnection->prepare($sql);
        $stmt->execute([
            $idJogo,
            $idJogador,
            $nomeJogador,
            $acertoFormatado,
            $perguntaId
        ]);

        
    } catch (PDOException $e) {
        // Tratamento do erro
        exit('Erro ao salvar jogada no banco de dados: ' . $e->getMessage());
    }
}



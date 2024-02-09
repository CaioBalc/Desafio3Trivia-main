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
    $perguntaId = $_SESSION['PerguntaId']; 
    $idJogo = $_SESSION['idJogo'];
    $idJogador = $_SESSION['idJogador'];
    $acertoFormatado = $acerto ? 'true' : 'false'; 

   
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
        
        exit('Erro ao salvar jogada no banco de dados: ' . $e->getMessage());
    }
}



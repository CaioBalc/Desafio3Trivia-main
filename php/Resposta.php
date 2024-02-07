<?php
session_start();
if (isset($_POST['Resposta'])) {
    $resposta = $_POST['Resposta'];
    

    // Verifica se a resposta enviada é a resposta correta
    if ($resposta == $_SESSION['RespostaCorreta']) {
        $_SESSION['Pontuacao']++; // Aumenta a pontuação
        echo 'Correto!';
    } else {
        $_SESSION['Pontuacao']--; // Diminui a pontuação
        echo 'Errado!';
    }
    $_SESSION['TentativasJogadas']++;

    /*
    echo 'Tipo de $resposta: ' . gettype($resposta) . "\n";
    echo 'Tipo de $respostaCorreta: ' . gettype($respostaCorreta) . "\n";
    */
}
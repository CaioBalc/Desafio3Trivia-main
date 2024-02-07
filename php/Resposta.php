<?php
session_start();
if (isset($_POST['resposta'])) {
    $resposta = $_POST['resposta'];

    // Verifica se a resposta enviada é a resposta correta
    if ($resposta == $_SESSION['RespostaCorreta']) {
        echo 'Correto!';
    } else {
        echo 'Errado!';
    }

    /*
    echo 'Tipo de $resposta: ' . gettype($resposta) . "\n";
    echo 'Tipo de $respostaCorreta: ' . gettype($respostaCorreta) . "\n";
    */
}
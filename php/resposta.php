<?php
session_start();
$respostaCorreta = $_SESSION['respostaCorreta'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resposta = $_POST['resposta'];
    echo "Resposta recebida: $resposta\n";
    // Verifique se a resposta está correta
    if ($resposta === $respostaCorreta) {
        echo "Correto!";
    } else if ($resposta !== $respostaCorreta) {
        echo "Errado!";
    }
    echo 'Tipo de $resposta: ' . gettype($resposta) . "\n";
    echo 'Tipo de $respostaCorreta: ' . gettype($respostaCorreta) . "\n";

}
?>

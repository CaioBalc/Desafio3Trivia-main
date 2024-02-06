<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resposta = $_POST['resposta'];
    // Verifique se a resposta está correta
    if ($resposta === $respostaCorreta) { // Suponha que 'resposta1' seja a resposta correta
        echo "Correto!";
    } else {
        echo "Errado!";
    }
}
?>

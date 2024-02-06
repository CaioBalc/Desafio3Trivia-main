<?php

# require "index.php";

$pergunta = "Pergunta";

$respostaCorreta = "Resposta correta";
$respostaIncorreta1 = "Errado";
$respostaIncorreta2 = "Errado";
$respostaIncorreta3 = "Errado";

$alternativas = array(
    $respostaCorreta,
    $respostaIncorreta1,
    $respostaIncorreta2,
    $respostaIncorreta3
);
shuffle($alternativas);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <title>Desafio Trivia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <Header>
        <h1 class="centralizar">TRIVIA</h1>
    </Header>

    <section>
        <h2 class="centralizar"><b>Tipo: </b></h2>
        <h2 class="centralizar"><b>Dificuldade: </b></h2>
        <h2 class="grid"><b>Pergunta: </b></h2>
        <?php
            echo "<p class='pergunta' id='pergunta'>$pergunta</p>";
        ?>
        <h2 class="grid"><b>Alternativas: </b></h2>
        <?php
            #$alternativas = ["String", "Talvez não"];
            foreach ($alternativas as $chave => $valor){
            echo "<button class='button' id='$chave'>$valor</button>";
            # print_r($valor);
            }
        ?>

        <script>
        document.querySelectorAll('.button').forEach(button => {
            button.addEventListener('click', event => {
                const id = event.target.id;
                fetch('resposta.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `resposta=${encodeURIComponent(id)}`,
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload();
                });
            });
        });
        </script>

    </section>

</body>
</html>
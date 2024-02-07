<?php


if (!isset($_SESSION['Pontuacao'])) {
    $_SESSION['Pontuacao'] = 0;
}
$pontuacao = $_SESSION['Pontuacao'];
$tipo = $_SESSION['Tipo'];
$dificuldade = $_SESSION['Dificuldade'];
$pergunta = $_SESSION['Pergunta'];
$respostaCorreta = $_SESSION['RespostaCorreta'];
$alternativas = $respostasIncorretas = $_SESSION['RespostasIncorretas'];

array_push($alternativas, $respostaCorreta);

shuffle($alternativas);

// Ver as respostas incorretas
/*
foreach($respostasIncorretas as $respostas){
    echo "<br>";
    echo $respostas;
    echo "<br>";
}
*/
echo "<br>";
echo $respostaCorreta;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <title>Desafio Trivia</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <Header>
        <h1 class="centralizar">TRIVIA</h1>
    </Header>

    <section>
        <h2 class="centralizar"><b>Pontuação: </b></h2>
        <?php
            echo "<p class='informacoes' id='Pontuacao'>$pontuacao</p>";
        ?>
        <h2 class="centralizar"><b>Tipo: </b></h2>
        <?php
            echo "<p class='informacoes' id='Tipo'>$tipo</p>";
        ?>
        <h2 class="centralizar"><b>Dificuldade: </b></h2>
        <?php
            echo "<p class='informacoes' id='Dificuldade'>$dificuldade</p>";
        ?>
        <h2 class="centralizar"><b>Pergunta: </b></h2>
        <?php
            echo "<p class='pergunta' id='Pergunta'>$pergunta</p>";
        ?>
        <h2 class="centralizar"><b>Alternativas: </b></h2>
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
                    fetch('Resposta.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `Resposta=${encodeURIComponent(event.target.textContent)}`,
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
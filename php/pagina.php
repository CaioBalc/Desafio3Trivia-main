<?php
require_once 'PedeParaBanco.php';//precisa para pegar o objeto da seç~ao

$PerguntaEscolhida = $_SESSION['PerguntaEscolhida'];
session_start();


$pergunta = $PerguntaEscolhida->pegaPergunta();

$respostaCorreta = $PerguntaEscolhida->pegaRespostaCorreta();
$_SESSION['respostaCorreta'] = $respostaCorreta;

$alternativas = $respostasIncorretas = $PerguntaEscolhida->pegaRespostasErradas();

array_push($alternativas, $respostaCorreta);

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
                    fetch('resposta.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `resposta=${encodeURIComponent(event.target.textContent)}`,
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
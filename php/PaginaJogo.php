<?php
session_start();

if (!isset($_SESSION['TentativasJogadas'])) {
    $_SESSION['TentativasJogadas'] = 0;
}
$tentativasJogadas = $_SESSION['TentativasJogadas'];
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
        <h3><b>TentativasJogadas: <?php echo $tentativasJogadas; ?></b></h3>
        <h1 class="centralizar">TRIVIA</h1>
    </Header>

    <section>
        <h2 class="centralizar"><b>Pontuação: <?php echo $pontuacao; ?></b></h2>

        <h2 class="centralizar"><b>Tipo: <?php echo $tipo; ?></b></h2>

        <h2 class="centralizar"><b>Dificuldade: <?php echo $dificuldade; ?></b></h2>
        
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
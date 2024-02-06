<?php

# require "index.php";

$pergunta;

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
        <h2 class="grid"><b>Alternativas: </b></h2>
        <?php
            $dados = ["String", "Talvez não"];
            foreach ($dados as $chave => $valor){
            echo "<button class='button' id='$chave'>$valor</button>";
            }
        ?>
    </section>

</body>
</html>
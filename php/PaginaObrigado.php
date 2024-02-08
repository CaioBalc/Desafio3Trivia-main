<?php
session_start();
// Se o botão de "Jogar Novamente" foi pressionado, reseta as variáveis de sessão
$_SESSION['Pontuacao'] = 0;

if (isset($_POST['jogar_novamente'])) {
    // Resetar as variáveis de sessão necessárias
    unset($_SESSION['nome_usuario']);
    unset($_SESSION['TentativasJogadas']);
    // Redireciona para a página inicial para começar de novo
    header('Location: index.php');
    exit;
}

// Checa se realmente completou 5 jogos para acessar essa página
if (!isset($_SESSION['TentativasJogadas']) || $_SESSION['TentativasJogadas'] < 5) {
    // Se não completou, redireciona para a página do jogo ou inicial
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Obrigado por Jogar!</title>
    <link rel="stylesheet" href="estilo.css"> <!-- Se houver algum arquivo de estilo -->
</head>
<body>
    <div class="container">
        <h1>Obrigado por jogar, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!</h1>
        <p>Esperamos que você tenha se divertido.</p>
        
        <!-- Formulário para jogar novamente, enviando o usuário de volta para o início -->
        <form method="post">
            <button type="submit" name="jogar_novamente">Jogar Novamente</button>
        </form>
    </div>
</body>
</html>

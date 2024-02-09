<?php
session_start();

$_SESSION['Pontuacao'] = 0;

if (isset($_POST['jogar_novamente'])) {
    
    unset($_SESSION['nome_usuario']);
    unset($_SESSION['TentativasJogadas']);
    
    header('Location: index.php');
    exit;
}


if (!isset($_SESSION['TentativasJogadas']) || $_SESSION['TentativasJogadas'] < 5) {
   
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Obrigado por Jogar!</title>
    <link rel="stylesheet" href="estilo.css"> 
</head>
<body>
    <div class="container">
        <h1>Obrigado por jogar, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!</h1>
        <p>Esperamos que você tenha se divertido.</p>
        
        
        <form method="post">
            <button type="submit" name="jogar_novamente">Jogar Novamente</button>
        </form>
    </div>
</body>
</html>

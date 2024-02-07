<?php
session_start();

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome_usuario']) && !empty(trim($_POST['nome_usuario']))) {
    // Armazena o nome do usuário na sessão
    $_SESSION['nome_usuario'] = trim($_POST['nome_usuario']);
    
    // Redireciona o usuário para o index.php para continuar o fluxo
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Inserir Nome</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { display: flex; flex-direction: column; width: 300px; }
        input[type="text"] { margin-bottom: 10px; }
    </style>
</head>
<body>
    <form action="PaginaNome.php" method="post">
        <label for="nome_usuario">Digite seu nome:</label>
        <input type="text" id="nome_usuario" name="nome_usuario" required>
        <input type="submit" value="Começar">
    </form>
</body>
</html>

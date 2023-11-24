<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Cadastro</title>
</head>
<body>
    <h2>Cadastro</h2>
    <form action="register_process.php" method="post">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" maxlength="10" required><br><br>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" minlength="10" maxlength="10" required><br><br>

        <label for="code">Código de Acesso:</label>
        <input type="text" id="code" name="code" minlength="30" maxlength="30" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:wght@300&family=Dongle:wght@300&family=Inter:wght@300&family=Phudu:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="menu_lateral">
        <div class="logodiv">
            <h2 class="logo">Resec 🎃</h2>
        </div>
        <ul>
            <li><a href="main.php">Home</a></li>
            <li><a href="forum.php">Fórum</a></li>
            <li><a href="arquivos.php">Arquivos</a></li>
            <div class="profile" style="padding-top: 340%;">
                <a href="perfil.php">
                    <h3>Perfil</h3>
                </a>
            </div>
        </ul>
    </div>
    <div class="divatualizacoes">
        <div class="atualizacoes">
            <h1 style="border-bottom: 2px solid black;">Perfil</h1>
            <?php
            if (isset($_SESSION["username"])) {
                $loggedInUsername = $_SESSION["username"];

                $cadastros = file("cadastros.txt", FILE_IGNORE_NEW_LINES);
                foreach ($cadastros as $cadastroLine) {
                    list($storedUsername, $storedPassword, $storedSecurityCode, $userIp) = explode(",", $cadastroLine);

                    if ($storedUsername === $loggedInUsername) {
                        echo "<p>Usuário: $storedUsername</p>";
                        echo "<p>Código de Login: $storedSecurityCode</p>";
                        echo "<p>IP de Criação da Conta: $userIp</p>";
                        break;
                    }
                }

                echo "<a href='logout.php'><button>Sair</button></a>";
            } else {
                echo "Faça login para acessar o perfil.";
            }
            ?>
        </div>
    </div>
</body>
</html>

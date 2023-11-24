<?php
    session_start();
    header("refresh: 10;");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum</title>
    <link rel="stylesheet" href="main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:wght@300&family=Dongle:wght@300&family=Inter:wght@300&family=Phudu:wght@500&display=swap" rel="stylesheet">
    <style>
        .user-admin {
            color: red;
            font-weight: bold;
        }
        .user-member {
            color: blue;
            font-weight: bold;
        }
    </style>
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
                <h3>Perfil</h3></a>
            </div>
        </ul>
    </div>
    <div class="divatualizacoes">
        <div class="atualizacoes">
            <h1 style="border-bottom: 2px solid black;">Fórum</h1>
            <div class="message-container">
                <?php
                if (isset($_SESSION["username"])) {
                    $loggedInUsername = $_SESSION["username"];
                    
                    $isAdmin = false;
                    $administrators = file("administradores.txt", FILE_IGNORE_NEW_LINES);
                    foreach ($administrators as $adminLine) {
                        list($adminUsername, $adminCode) = explode(",", $adminLine);
                        $cadastros = file("cadastros.txt", FILE_IGNORE_NEW_LINES);
                        foreach ($cadastros as $cadastroLine) {
                            list($storedUsername, $storedPassword, $storedSecurityCode, $userIp) = explode(",", $cadastroLine);
                                if ($adminUsername === $loggedInUsername && $adminCode === $storedSecurityCode) {
                                    $isAdmin = true;
                                    break;
                                }
                        }
                    }

                    $messages = file("forum.txt", FILE_IGNORE_NEW_LINES);
                    if ($messages !== false) {
                        foreach ($messages as $messageLine) {
                            list($user, $message, $date) = explode(",", $messageLine);
                            $displayUser = $user === $loggedInUsername ? $loggedInUsername : $user;
                            $userClass = $isAdmin ? "user-admin" : "user-member";
                            $userTag = $isAdmin ? "[Administrador] " : "";

                            echo "<div class='message'>";
                            echo "<span class='$userClass'>$userTag$displayUser</span>";
                            echo "<span class='date'>$date</span>";
                            echo "<p class='content'>$message</p>";
                            echo "<svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d='M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z'/></svg>";
                            echo "</div>";
                        }
                    }
                }
                ?>
            </div>
            <div class="message-form">
                <?php
                if (isset($_SESSION["username"])) {
                    echo "<h2 style='border-top: 2px solid black;'>Enviar Mensagem</h2>";
                    echo "<form action='post_message.php' method='post'>";
                    echo "<textarea name='message' placeholder='Digite sua mensagem...' required style='width: 90%;'></textarea>";
                    echo "<input type='submit' value='Enviar'>";
                    echo "</form>";
                    echo "<form action='refresh.php' method='post'>";
                    echo "<input type='submit' value='Refresh'>";
                    echo "</form>";
                } else {
                    echo "Faça login para enviar mensagens.";
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        function scrollToBottom() {
            var messageContainer = document.querySelector(".message-container");
            messageContainer.scrollTop = messageContainer.scrollHeight;
        }

        window.onload = function () {
            scrollToBottom();
        };
        
        function handleEnterKey(event) {
            if (event.keyCode === 13 && !event.shiftKey) {
                event.preventDefault(); // Impede que a tecla "Enter" crie uma nova linha no textarea
                document.querySelector("#message-form").submit(); // Envia o formulário
            }
        }

        // Adicione um ouvinte de evento para capturar a tecla "Enter" no textarea
        const messageTextarea = document.querySelector("textarea[name='message']");
        messageTextarea.addEventListener("keydown", handleEnterKey);
    </script>
</body>
</html>

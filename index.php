<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
    <title>Painel de Login</title>
    <?php
        $ipaddr = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');

        $found2 = false;
        $lines = file("blockip.txt", FILE_IGNORE_NEW_LINES);

        foreach ($lines as $storedIp) {
            if ($storedIp === $ipaddr) {
                $found2 = true;
                break;
            }
        }

        if ($found2) {
            echo "Site indisponível no momento. Tente novamente ou entre em contato com o suporte.";
            exit();
        } else {
            echo "";
        }
    ?>
</head>

<body>
    <form action="login.php" method="post">
        <input placeholder="User" type="text" id="username" name="username" maxlength="10" required><br><br>
        <input placeholder="Pass" type="password" id="password" name="password" minlength="10" maxlength="10" required><br><br>
        <input placeholder="Security Code" type="text" id="security_code" name="security_code" maxlength="6" required><br><br>
        <div style="display: inline-block;">
            <input type="submit" value="Login"> <a href="register.php"> <span style="font-size: 10px;">Cadastre-se</span> </a>
        </div>
    </form>
</body>
</html>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $securityCode = $_POST["security_code"];
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
    if (strlen($username) > 10 || strlen($password) > 15 || strlen($securityCode) > 6) {
        echo "Credenciais inválidas. Tente novamente.";
        exit();
    }
    $found = false;
    $lines = file("cadastros.txt", FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        list($storedUsername, $storedPassword, $storedSecurityCode, $userip) = explode(",", $line);

        if ($storedUsername === $username && $storedPassword === $password && $storedSecurityCode === $securityCode) {
            $_SESSION["username"] = $username; // Definindo a variável de sessão
            header("Location: main.php");
            exit();
        }
    }

    echo "Credenciais inválidas. Tente novamente.";
}
?>

<?php
session_start();
date_default_timezone_set("America/Sao_Paulo"); // Definir o fuso horário para Brasília

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["username"])) {
    $message = $_POST["message"];
    $user = $_SESSION["username"]; // Usar o nome de usuário logado

    $dataHora = date("d/m/Y H:i:s"); // Formato "dd/mm/aaaa H:i:s"
    $messageLine = "$user ,$message,$dataHora" . PHP_EOL;

    file_put_contents("forum.txt", $messageLine, FILE_APPEND);
}

header("Location: forum.php");
exit();
?>

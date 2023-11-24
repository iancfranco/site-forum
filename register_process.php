<?php
session_start();
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $code = $_POST["code"];
    
    $codes = file("access.txt", FILE_IGNORE_NEW_LINES);
    $foundCodeIndex = array_search($code, $codes);

    if ($foundCodeIndex !== false) {
        array_splice($codes, $foundCodeIndex, 1);
        
        file_put_contents("access.txt", implode("\n", $codes));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            
        
            $ip = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');
            $filePath = "cadastros.txt";
            
            if (file_exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                if (strpos($fileContents, "$ip") !== false) {
                    echo "Já existe um cadastro associado a este IP.";
                    exit;
                }
            }
        
            if (file_exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                if (strpos($fileContents, "Usuário: $username") !== false) {
                    echo "O usuário já existe. Escolha outro nome de usuário.";
                    exit;
                }
            }
        
            $securityCode = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
        
            $data = "\n$username,$password,$securityCode,$ip";
        
            $file = fopen($filePath, "a");
        
            fwrite($file, $data);
        
            fclose($file);
        
            echo "Cadastro realizado com sucesso!";?><br><?php
            echo "Seu usuário: $username";?><br><?php
            echo "Seu código de segurança: $securityCode";?><br><?php
            echo "Obs: guarde seu código de segurança já que não é possível recupera-lo e sem ele você não realiza login.";?><br><?php
        }
    } else {
        echo "Código de Acesso inválido.";
        exit;
    }
}
?>


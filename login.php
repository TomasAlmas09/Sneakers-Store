<!DOCTYPE html>
<html>

<head>

<?php  
// Inclui o arquivo com a barra de navegação
require('navbar.php');
?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<br><br>
<br><br>
<form action="login.php" method="post" style="max-width:500px;margin:auto;">
    <h2>Formulário de Login</h2>

    <!-- Campo para inserção do email -->
    <div class="input-container">
        <i class="fa fa-envelope icon"></i>
        <input class="input-field" type="email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" id="email" name="email" placeholder="Email" required>
    </div>

    <!-- Campo para inserção da senha -->
    <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Senha" name="senha" id="senha" required>
    </div>

    <!-- Checkbox para mostrar a senha -->
    <input type="checkbox" onclick="myFunction()">Mostrar senha<br><br>

    <!-- Botão de submissão do formulário -->
    <button type="submit" class="btn" name="login">Login</button>
    <br><br>
    <!-- Link para o formulário de registro -->
    Ainda não tem conta? Clique <a href="registo.php">aqui</a>
</form>

<!-- Script para mostrar/ocultar a senha -->
<script>
    function myFunction() {
        var x = document.getElementById("senha");
        if (x.type === "password") {
            x.type = "textbox";
        } else {
            x.type = "password";
        }
    }
</script>

<?php
// Verifica se o formulário de login foi submetido
if (isset($_POST['login'])) {
    // Obtém as credenciais do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Executa a consulta SQL para verificar as credenciais
    $existe = "SELECT * FROM clientes WHERE email='" . $email . "' AND senha='" . $senha . "'";
    $faz_existe = mysqli_query($con, $existe);
    $num_registos = mysqli_num_rows($faz_existe);
    $registos = mysqli_fetch_array($faz_existe);

    // Define a variável de sessão 'nome' com o nome do usuário
    $_SESSION["nome"] = $registos["nome"];

    // Verifica se as credenciais são válidas
    if ($num_registos == 1) {
        // Obtém o nível de acesso do usuário
        $consulta = "SELECT lvl FROM clientes WHERE email='" . $email . "'";
        $resultado = mysqli_query($con, $consulta);
        $registo = mysqli_fetch_array($resultado);
        $nivel = $registo['lvl'];

        // Redireciona com base no nível de acesso
        if ($nivel > 1) {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('LOGIN COM SUCESSO. BEM-VINDO À PÁGINA DE ADMIN!')
            window.location.href='entrada_admin.php';
            </SCRIPT>");
        } else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('LOGIN COM SUCESSO!')
            window.location.href='entrada.php';
            </SCRIPT>");
        }
    } else {
        // Exibe uma mensagem de erro se as credenciais são inválidas
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('EMAIL E SENHA ERRADOS!')
        window.location.href='login.php';
        </SCRIPT>");
        // Destrói a sessão
        session_destroy();
    }
}
?>
</body>
</html>

<?php
// Inicia a sessão
session_start();

// Conecta ao banco de dados
$con = mysqli_connect("localhost", "root", "", "lojadetenis");

// Verifica a conexão
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Consulta o nível do usuário logado
$consulta = "SELECT lvl FROM clientes WHERE nome='" . $_SESSION['nome'] . "'";
$resultado = mysqli_query($con, $consulta);
$registo = mysqli_fetch_array($resultado);

// Obtém o nível do usuário
$nivel = $registo['lvl'];

// Verifica se a sessão está vazia ou o nível é menor que 2
if (empty($_SESSION) || $nivel < 2) {
    
        echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Faça login primeiro ou entre com uma conta admin!')
                window.location.href='entrada.php';
                </SCRIPT>");
    
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navbar.css">
    <title>Sneakers Store - Admin</title>
    <link rel="shortcut icon" href="imgs/logo_mini.jpg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <ul>
        <li class="logo" style="margin-left: 20px;"><a href="entrada_admin.php"><img src="imgs/logo.png" alt="Logo"></a></li>
        <li><a href="entrada_admin.php">Início</a></li>
        <li><a href="adm_produtos.php">Gerir Produtos</a></li>
        <li><a href="encomendas_adm.php">Encomendas</a></li>

        <?php
        // Exibe opções adicionais se o nível for maior ou igual a 2
        if ($nivel >= 2) {
            echo '
                <li class="dir"><a href="atualizar.php"> Mudar Senha </a></li>
                <li style="margin-right: 20px;"><a href="logout.php"> Sair </a></li>';
        }
        if (!$_SESSION || $nivel<2) {
            header("Location: entrada.php");
        }
        ?>

    </ul>

</body>

</html>

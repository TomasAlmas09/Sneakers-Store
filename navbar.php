<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sneakers Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="shortcut icon" href="imgs/logo_mini.jpg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<ul>
    <li class="logo" style="margin-left: 20px;"><a href="entrada.php"><img src="imgs/logo.png" alt="Logo"></a></li>
    <li><a href="entrada.php">Início</a></li>
    <li><a href="produtos.php">Tenis</a></li>
    <li><a href="encomendas.php">Encomendas</a></li>

    <?php
    $con = mysqli_connect("localhost", "root", "", "lojadetenis");
    
    // Verifica a conexão
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    session_start();

    if (!$_SESSION) {
        // Se não houver sessão, exibe opção de login/registo
        echo '<li class="dir"><a href="login.php">Login/Registo</a></li>';
    } else {
        // Se houver sessão, exibe opções de mudar senha e sair
        echo '<li class="dir"><a href="view_cart.php"> Carrinho </a></li>
        <li style="margin-right: 20px;"><a href="atualizar.php"> Mudar Senha </a></li>
              <li style="margin-right: 20px;"><a href="logout.php"> Sair </a></li>';
    }
    ?>

</ul>

</body>

</html>

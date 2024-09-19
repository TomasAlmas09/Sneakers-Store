<?php
    session_start();

    // Verifica se há uma sessão ativa, caso contrário, redireciona para a página de entrada
    if (!$_SESSION) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Faça login primeiro!')
                window.location.href='entrada.php';
                </SCRIPT>");
    }

    // Conexão com o banco de dados
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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sneakers Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="shortcut icon" href="imgs/logo_mini.jpg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Link para o Font Awesome para usar os ícones no formulário -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <ul>
        <li class="logo" style="margin-left: 20px;"><a href="entrada.php"><img src="imgs/logo.png" alt="Logo"></a></li>

        <?php if ($nivel >= 2): ?>
            <!-- Menu para administradores -->
            <li><a href="entrada_admin.php">Início</a></li>
            <li><a href="adm_produtos.php">Gerir Produtos</a></li>
            <li><a href="encomendas_adm.php">Encomendas</a></li>
        <?php else: ?>
            <!-- Menu para usuários normais -->
            <li><a href="entrada.php">Início</a></li>
            <li><a href="produtos.php">Tenis</a></li>
            <li><a href="encomendas.php">Encomendas</a></li>
        <?php endif; ?>

        <!-- Exibição de opções de conta, carrinho e logout para todos os usuários logados -->
        <li class="dir"><a href="view_cart.php">Carrinho</a></li>
        <li style="margin-right: 20px;"><a href="atualizar.php">Mudar Senha</a></li>
        <li style="margin-right: 20px;"><a href="logout.php">Sair</a></li>
    </ul>

    <!-- Formulário de alteração de senha -->
    <br><br><br><br>
    <form action="atualizar.php" method="post" style="max-width:500px;margin:auto;">
        <h2>Alterar Senha</h2>

        <!-- Campo para a senha atual -->
        <div class="input-container">
            <i class="fa fa-key icon"></i>
            <input class="input-field" type="password" placeholder="Senha atual" name="senha_agora" id="senha_agora" required>
        </div>
        <input type="checkbox" onclick="myFunctionSenha1()">Mostrar senha<br><br>

        <!-- Campo para a nova senha -->
        <div class="input-container">
            <i class="fa fa-key icon"></i>
            <input class="input-field" type="password" placeholder="Senha nova" name="senha" id="senha" required>
        </div>
        <input type="checkbox" onclick="myFunctionSenha2()">Mostrar senha<br><br>

        <!-- Botão de confirmação -->
        <button type="submit" class="btn" name="confirmar">Confirmar</button>
    </form>

    <script>
        // Função para mostrar/ocultar senha atual
        function myFunctionSenha1() {
            var x = document.getElementById("senha_agora");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        // Função para mostrar/ocultar nova senha
        function myFunctionSenha2() {
            var x = document.getElementById("senha");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>

<?php
    // Verifica se o formulário foi submetido
    if (isset($_POST['confirmar'])) {
        $senha_agora = trim($_POST['senha_agora']);
        $senha = trim($_POST['senha']);

        // Proteção contra SQL Injection
        $senha_agora = mysqli_real_escape_string($con, $senha_agora);
        $senha = mysqli_real_escape_string($con, $senha);

        // Verifica se a senha atual está correta
        $existe = "SELECT senha FROM clientes WHERE senha='$senha_agora' AND nome='" . $_SESSION['nome'] . "'";
        $faz_existe = mysqli_query($con, $existe);
        $num_registos = mysqli_num_rows($faz_existe);

        if ($num_registos == 1) {
            // Atualiza a senha no banco de dados
            $update = "UPDATE clientes SET senha = '$senha' WHERE nome = '" . $_SESSION['nome'] . "'";
            $resultado = mysqli_query($con, $update);

            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('SENHA ATUALIZADA!')
                window.location.href='entrada.php';
            </SCRIPT>");
        } else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('SENHA ATUAL INCORRETA!')
                window.location.href='atualizar.php';
            </SCRIPT>");
        }
    }
?>

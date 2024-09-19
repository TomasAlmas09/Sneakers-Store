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

    <form action="registo.php" method="post" style="max-width:500px;margin:auto;">
        <h2>Formulário de Registo</h2>

        <div class="input-container">
            <i class="fa fa-user icon"></i>
            <input class="input-field" type="textbox" placeholder="Nome" name="nome" required>
        </div>

        <div class="input-container">
            <i class="fa fa-envelope icon"></i>
            <input class="input-field" type="email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-container">
            <i class="fa fa-key icon"></i>
            <input class="input-field" type="password" placeholder="Senha" name="senha" id="senha" required>
        </div>

        <input type="checkbox" onclick="myFunction()">Mostrar senha<br><br>
        <button type="submit" class="btn" name="registar">Registar</button>
        <br><br>
        Já tem conta? Clique <a href="login.php">aqui</a>
    </form>

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
    if (isset($_POST['registar'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $duplica = mysqli_query($con, "SELECT * FROM clientes WHERE email = '$email'");

        if (mysqli_num_rows($duplica) === 0) {
            $inserir = "INSERT INTO clientes VALUES ('$nome', '$email', '$senha', 1)";
            $rsl = mysqli_query($con, $inserir);

            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Registo concluído')
            window.location.href='login.php';
            </SCRIPT>");
        } else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Email já registrado. Faça login ou tente outro.')
            window.location.href='registo.php';
            </SCRIPT>");
        }
    }
    ?>
</body>

</html>

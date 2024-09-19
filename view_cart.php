<!DOCTYPE html>
<html>
<head>
    <style>
        .cart-container {
            margin: 0 auto; /* Centraliza horizontalmente */
            width: 80%; /* Define a largura do contêiner */
        }
        .cart-table {
            width: 100%; /* Ocupa toda a largura do contêiner */
            border-collapse: collapse; /* Junta as bordas das células */
            margin-bottom: 20px; /* Espaço entre a tabela e o botão */
        }
        .cart-table th, .cart-table td {
            border: 1px solid #ddd; /* Borda das células */
            padding: 8px; /* Espaçamento interno das células */
            text-align: left; /* Alinhamento do texto nas células */
        }
        .cart-button {
            display: block; /* Torna o botão um bloco para ocupar a largura */
            width: 100%; /* Ocupa toda a largura disponível */
            padding: 10px; /* Espaçamento interno do botão */
            background-color: #4CAF50; /* Cor de fundo do botão */
            color: white; /* Cor do texto do botão */
            border: none; /* Remove a borda do botão */
            cursor: pointer; /* Altera o cursor ao passar por cima */
            text-align: center; /* Alinha o texto ao centro */
            text-decoration: none; /* Remove sublinhado do texto */
            font-size: 16px; /* Tamanho da fonte */
        }
    </style>
</head>
<body>

<?php
// Inclui o arquivo com a barra de navegação
require('navbar.php');

if (!$_SESSION) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Faça login primeiro!')
            window.location.href='entrada.php';
            </SCRIPT>");
    exit();
}
?>

<br><br><br><br><center><h2>Seu Carrinho</h2></center>

<div class="cart-container">
    <?php
    $nome_cliente = $_SESSION['nome'];
    $consulta_carrinho = "SELECT * FROM carrinho WHERE nome_cliente = '$nome_cliente'";
    $resultado_carrinho = mysqli_query($con, $consulta_carrinho);

    if (mysqli_num_rows($resultado_carrinho) > 0) {
        echo '<table class="cart-table">';
        echo '<tr><th>Produto</th><th>Tamanho</th><th>Preço</th></tr>';
        while ($item = mysqli_fetch_assoc($resultado_carrinho)) {
            echo '<tr>';
            echo '<td>' . $item['nome_tenis'] . '</td>';
            echo '<td>' . $item['tamanho'] . '</td>';
            echo '<td>' . $item['preco'] . '€</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<form method="post" action="payment.php">';
        echo '<input type="submit" name="proceed_to_payment" value="Finalizar Compra" class="cart-button">';
        echo '</form>';
    } else {
        echo '<p>Seu carrinho está vazio.</p>';
    }
    ?>
</div>

</body>
</html>

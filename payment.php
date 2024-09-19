<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
        }
        input[type="text"], input[type="email"], input[type="submit"], input[type="radio"] {
            margin-top: 5px;
            padding: 10px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #f1f1f1;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .payment-info {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Escolha o Método de Pagamento</h2>

    <form method="post">
        <div>
            <input type="radio" id="paypal" name="metodo_pagamento" value="Paypal" required>
            <label for="paypal">Paypal</label>
        </div>
        <div>
            <input type="radio" id="cartao" name="metodo_pagamento" value="Cartão de Crédito" required>
            <label for="cartao">Cartão de Crédito</label>
        </div>

        <div id="paypal_info" class="payment-info">
            <label for="paypal_email">Email do Paypal:</label>
            <input type="email" id="paypal_email" name="paypal_email">
        </div>

        <div id="cartao_info" class="payment-info">
            <label for="cc_nome">Nome no Cartão:</label>
            <input type="text" id="cc_nome" name="cc_nome">
            <label for="cc_numero">Número do Cartão:</label>
            <input type="text" id="cc_numero" name="cc_numero">
            <label for="cc_expiracao">Data de Expiração:</label>
            <input type="text" id="cc_expiracao" name="cc_expiracao" placeholder="MM/AA">
            <label for="cc_cvv">CVV:</label>
            <input type="text" id="cc_cvv" name="cc_cvv">
        </div>

        <br><input type="submit" name="confirm_payment" value="Confirmar Pagamento">
    </form>
</div>

<script>
document.querySelectorAll('input[name="metodo_pagamento"]').forEach((elem) => {
    elem.addEventListener('change', function () {
        if (this.value === 'Paypal') {
            document.getElementById('paypal_info').style.display = 'block';
            document.getElementById('cartao_info').style.display = 'none';
        } else if (this.value === 'Cartão de Crédito') {
            document.getElementById('paypal_info').style.display = 'none';
            document.getElementById('cartao_info').style.display = 'block';
        }
    });
});
</script>

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

if (isset($_POST['confirm_payment'])) {
    $metodo_pagamento = $_POST['metodo_pagamento'];

    if ($metodo_pagamento == 'Cartão de Crédito') {
        $cc_nome = $_POST['cc_nome'];
        $cc_numero = $_POST['cc_numero'];
        $cc_expiracao = $_POST['cc_expiracao'];
        $cc_cvv = $_POST['cc_cvv'];

        if (empty($cc_nome) || empty($cc_numero) || empty($cc_expiracao) || empty($cc_cvv)) {
            echo "<script>alert('Por favor, preencha todas as informações do cartão de crédito.');</script>";
        } else {
            echo "<script>alert('Pagamento com cartão de crédito confirmado!');window.location.href='encomendas.php';</script>";
                 
        }
    } else if ($metodo_pagamento == 'Paypal') {
        $paypal_email = $_POST['paypal_email'];

        if (empty($paypal_email)) {
            echo "<script>alert('Por favor, preencha o email do Paypal.');</script>";
        } else {
            echo "<script>alert('Pagamento com Paypal confirmado!');window.location.href='encomendas.php';</script>";
        }
    }

    // Transferir itens do carrinho para pedidos
    $nome_cliente = $_SESSION['nome'];
    $consulta_carrinho = "SELECT * FROM carrinho WHERE nome_cliente = '$nome_cliente'";
    $resultado_carrinho = mysqli_query($con, $consulta_carrinho);

    // Após verificar o método de pagamento e antes de inserir o pedido
while ($item = mysqli_fetch_assoc($resultado_carrinho)) {
    $nome_tenis = $item['nome_tenis'];
    $tamanho = $item['tamanho'];
    $preco = $item['preco'];
    
    // Inserir na tabela encomenda
    $inserir_encomenda = "INSERT INTO encomenda (nome_cliente, nome_tenis, tamanho, preco_total, metodo_pagamento) 
                          VALUES ('$nome_cliente', '$nome_tenis', '$tamanho', '$preco', '$metodo_pagamento')";
    mysqli_query($con, $inserir_encomenda);
}

// Após inserir todos os pedidos, você pode limpar o carrinho
$limpar_carrinho = "DELETE FROM carrinho WHERE nome_cliente = '$nome_cliente'";
mysqli_query($con, $limpar_carrinho);
}
?>
</body>
</html>

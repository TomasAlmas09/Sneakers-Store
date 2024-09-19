<!DOCTYPE html>
<html>
<head>
<?php  
// Inclui o arquivo com a barra de navegação
require('navbar.php');

if (!$_SESSION) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Faça login primeiro!')
            window.location.href='entrada.php';
            </SCRIPT>");
}
?>
</head>
<body>

<br><br><br><br>

<?php

// Verifica se a variável de sessão "nome" está definida
if (isset($_SESSION["nome"])) {

    // Consulta SQL para obter encomendas relacionadas ao cliente logado
    $cliente_nome = $_SESSION["nome"];
    $sql = "SELECT * FROM encomenda WHERE nome_cliente = '$cliente_nome'";
    $result = $con->query($sql);

    // Verifica se há resultados
    if ($result->num_rows > 0) {
        // Exibe os resultados em uma tabela HTML
        echo "<h2 style='margin-left: 155px;'>Minhas Encomendas</h2><center>
        <table>
                <tr>
                  <th>Código da Encomenda</th>
                  <th>Nome do Tênis</th>
                  <th>Tamanho</th>
                  <th>Preço Total</th>
                </tr>";

        // Exibe os dados de cada encomenda
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['codigo_encomenda']}</td>
                    <td>{$row['nome_tenis']}</td>
                    <td>{$row['tamanho']}</td>
                    <td>{$row['preco_total']}€</td>
                  </tr>";
        }

        echo "</table></center>";
    } else {
        echo "Nenhuma encomenda encontrada para o cliente '$cliente_nome'.";
    }

    // Fecha a conexão
    $con->close();
} else {
    echo "A variável de sessão 'nome' não está definida.";
}
?>

</body>

</html>

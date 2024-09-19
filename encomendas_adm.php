<!DOCTYPE html>
<html>
<head>
<?php  
require('navbar_admin.php');


?>
</head>
<body>

<br><br><br><br>

<?php
// Conectar ao banco de dados (substitua pelos detalhes reais)

// Verificar se a variável de sessão está definida
if (isset($_SESSION["nome"])) {
    // Consulta SQL para obter encomendas relacionadas ao cliente logado
    $cliente_nome = $_SESSION["nome"];
    $sql = "SELECT * FROM encomenda";
    $result = $con->query($sql);

    // Verificar se há resultados
    if ($result->num_rows > 0) {
        // Exibir os resultados em uma tabela HTML
        echo "<h2 style='margin-left: 155px;'>Encomendas</h2>
        <a style='margin-left: 155px; color: black;' href='rmv_encomenda.php'>Remover encomenda</a><center>
        <table>
                <tr>
                  <th>Código da Encomenda</th>
                  <th>Nome do Cliente</th>
                  <th>Nome do Tênis</th>
                  <th>Tamanho</th>
                  <th>Preço Total</th>
                </tr>";

        // Exibir os dados de cada encomenda
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['codigo_encomenda']}</td>
                    <td>{$row['nome_cliente']}</td>
                    <td>{$row['nome_tenis']}</td>
                    <td>{$row['tamanho']}</td>
                    <td>{$row['preco_total']}€</td>
                  </tr>";
        }

        echo "</table></center>";
    } else {
        echo "Nenhuma encomenda encontrada para o cliente '$cliente_nome'.";
    }
} 

?>

</body>

</html>

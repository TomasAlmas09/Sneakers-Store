<!DOCTYPE html>
<html>
<head>
<?php  
require('navbar_admin.php');



// Executa uma consulta para obter as marcas distintas dos tênis
    $query = mysqli_query($con, 'SELECT DISTINCT marca FROM tenis');?>  
</head>
<body>

    <br><br>
    <br><br>

    <div class="padrao">
        <h1>Adicionar Produto</h1>
        <!-- Formulário para adicionar um novo produto -->
        <form action="add_prod.php" method="post">
            <h4>Nome do Tênis:</h4>
            <input type="text" name="nome" required><br>

            <h4>Marca:</h4>
            <input type="text" name="marca" required><br>

            <h4>Preço:</h4>
            <input type="text" name="preco" required><br>

            <h4>Imagem:</h4>
            <input type="file" name="imagem" id="imagem" required><br><br>

            <input type="submit" name="inserir" value="Adicionar Produto">
        </form>
    </div>

</body>

</html>

<?php
// Verifica se o formulário foi submetido
if (isset($_POST['inserir'])){
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $preco = $_POST['preco'];
    $img = $_POST['imagem']; 

    // Evita a duplicação verificando se o nome do tênis já existe no sistema
    $evitaDuplicacao = mysqli_query($con, "SELECT * FROM tenis WHERE nome_tenis = '$nome'");

    if(mysqli_num_rows($evitaDuplicacao) === 0){
        // Insere o novo produto no banco de dados
        $insere = "INSERT INTO tenis (nome_tenis, marca, preco, img) VALUES ('$nome', '$marca', '$preco', '$img')";
        $resultado = mysqli_query($con, $insere);

        // Exibe uma mensagem de sucesso e redireciona para a página de administração de produtos
        echo ("<script>
            alert('PRODUTO ADICIONADO!');
            window.location.href='adm_produtos.php';
        </script>");
    } else {
        // Exibe uma mensagem de erro e redireciona de volta para a página de adição de produtos
        echo ("<script>
            alert('PRODUTO JÁ ESTÁ NO SISTEMA!');
            window.location.href='add_prod.php';
        </script>");
    }
}
?>

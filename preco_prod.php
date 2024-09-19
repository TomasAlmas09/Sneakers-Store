<!DOCTYPE html>
<html>
    <head>
<?php
    // Inclua o arquivo da barra de navegação do admin
    require('navbar_admin.php');

    // Execute a consulta para obter marcas distintas de tênis
    $query = mysqli_query($con, 'SELECT DISTINCT marca FROM tenis');
    ?>
    </head>
<body>

  

    <br><br>
    <br><br>

    <div class="padrao">
        <h1>Alterar Preço</h1>
        <form action="preco_prod.php" method="post">
            <h4>Tenis:</h4>
            <select name="tenis" required>
                <option value="">Selecione...</option>
                <?php
                // Preencha as opções do seletor com marcas e tênis correspondentes
                while ($marca_row = mysqli_fetch_assoc($query)) {
                    $marca = $marca_row['marca'];
                    echo '<optgroup label="' . $marca . '">';

                    $tenis_query = mysqli_query($con, "SELECT nome_tenis FROM tenis WHERE marca='$marca'");
                    while ($tenis_row = mysqli_fetch_assoc($tenis_query)) {
                        $tenis = $tenis_row['nome_tenis'];
                        echo '<option value="' . $tenis . '">' . $tenis . '</option>';
                    }

                    echo '</optgroup>';
                }
                ?>
            </select>
            <h4>Preço novo:</h4>
            <input type="text" name="preco" required><br><br>

            <input type="submit" name="alterar" value="Alterar">
        </form>
    </div>

</body>

</html>

<?php

// Verifica se o formulário foi enviado
if (isset($_POST['alterar'])) {
    // Obtém os valores do formulário
    $tenis = $_POST['tenis'];
    $preco = $_POST['preco'];

    // Atualiza o preço no banco de dados
    $update = "UPDATE tenis SET preco = '$preco' WHERE nome_tenis = '$tenis'";
    $resultado = mysqli_query($con, $update);

    // Exibe uma mensagem e redireciona para a página de administração de produtos
    echo ("<script>
            alert('PREÇO ATUALIZADO!')
            window.location.href='adm_produtos.php';
          </script>");
}
?>

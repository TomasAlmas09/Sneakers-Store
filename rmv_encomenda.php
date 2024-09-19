<html>
<head>
<?php
    require('navbar_admin.php');

    // Consulta para obter os IDs das encomendas
    $query = mysqli_query($con, 'SELECT codigo_encomenda FROM encomenda');
    ?>
</head>
<body>

   

    <br><br>
    <br><br>

    <div class="padrao">
        <h1>Remover Produto</h1>
        <h4>Selecione o ID da encomenda que deseja eliminar:</h4>
        <form action="rmv_encomenda.php" method="post">
            <select name="encomenda" required>
                <option value="">Selecione...</option>
                <?php
                // Loop para exibir os IDs das encomendas na caixa de seleção
                while ($encomenda_row = mysqli_fetch_assoc($query)) {
                    $id_encomenda = $encomenda_row['codigo_encomenda'];
                    echo '<option value="' . $id_encomenda . '">' . $id_encomenda . '</option>';
                }
                ?>
            </select>

            <input type="submit" name="remover" value="Remover">
        </form>
    </div>

    <?php
    if (isset($_POST['remover'])){
        $encomenda = $_POST['encomenda'];

        // Ajuste da query para remover a encomenda correta
        $remove = "DELETE FROM encomenda WHERE codigo_encomenda = '$encomenda'";
        mysqli_query($con, $remove);

        echo ("<script>
                alert('Encomenda removida!');
                window.location.href='adm_produtos.php';
              </script>");
    }
    ?>

</body>

</html>

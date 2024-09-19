<!DOCTYPE html>
<html>
<head>
<?php
    require('navbar_admin.php');

    $query = mysqli_query($con, 'SELECT DISTINCT marca FROM tenis');
    ?>
</head>
<body>



    <br><br>
    <br><br>

    <div class="padrao">
        <h1>Remover Produto</h1>
        <form action="rmv_prod.php" method="post">
            <select name="tenis">
                <option value="">Selecione...</option>
                <?php
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
            <input type="submit" name="remover" value="Remover">
        </form>
    </div>

</body>

</html>

<?php

if (isset($_POST['remover'])){
    $tenis = $_POST['tenis'];

    $remove = "DELETE FROM tenis WHERE nome_tenis = '".$tenis."'";
    mysqli_query($con, $remove);

    echo ("<script>
            alert('TENIS REMOVIDO!');
            window.location.href='adm_produtos.php';
          </script>");
}

?>
<style>
    .padrao {
        margin-left: 450px; /* Adiciona margem externa de 450 pixels ao redor do formulário */
        margin-right: 450px;
    }
</style>

<!DOCTYPE html>
<html>
<head>
<br><br><br>
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

if (isset($_POST['add_to_cart'])) {
    $tenis = $_POST['tenis'];
    $tam = $_POST['tam'];

    $consulta = "SELECT preco FROM tenis WHERE nome_tenis='" . $tenis . "'";
    $resultado = mysqli_query($con, $consulta);
    $registo = mysqli_fetch_array($resultado);
    $preco = $registo['preco'];

    $nome_cliente = $_SESSION['nome'];

    $inserir_carrinho = "INSERT INTO carrinho (nome_cliente, nome_tenis, tamanho, preco) VALUES ('$nome_cliente', '$tenis', '$tam', '$preco')";
    mysqli_query($con, $inserir_carrinho);

    echo ("<script>
        alert('Produto adicionado ao carrinho!');
        window.location.href='view_cart.php';
    </script>");
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .container {
            margin: 50px auto;
            width: 80%;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        #formContainer {
            width: 48%;
        }

        #imagemTenis {
            margin-right: 100px;
            max-width: 300px;
            max-height: 250px;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }

        #precoTenis {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<br><br><br>

<div class="container">
    <div id="formContainer">
        <h2>Comprar</h2>
        <form action="" method="post">
            <h4>Selecione um Par:</h4>
            <select name="tenis" id="tenis" required>
                <option value="">Selecione...</option>
                <?php
                $query = mysqli_query($con, 'SELECT nome_tenis, marca, img, preco FROM tenis ORDER BY marca ASC');
                $marcas = array();

                while ($row = mysqli_fetch_assoc($query)) {
                    $marca = $row['marca'];

                    if (!in_array($marca, $marcas)) {
                        $marcas[] = $marca;
                        echo '<optgroup label="' . $marca . '">';
                    }

                    $tenis = $row['nome_tenis'];
                    $imagem = $row['img'];
                    $preco = $row['preco'];
                    echo "<option value='$tenis' data-imagem='$imagem' data-preco='$preco'>$tenis</option>";
                }
                ?>
            </select>
            <h4>Tamanho:</h4>
            <select name="tam" required>
                <option value="" disabled selected hidden>Selecione...</option>
                <option value="34">34</option>
                <option value="36">36</option>
                <option value="38">38</option>
                <option value="40">40</option>
                <option value="42">42</option>
                <option value="44">44</option>
            </select><br>
            <br><br>
            <input type="submit" name="add_to_cart" value="Adicionar ao Carrinho">
        </form><br>
        <a href="view_cart.php" style="font-weight: bold; color: black; text-decoration: underline;">Ver Carrinho</a>
    </div>
    <div id="imagemTenis">
        <!-- Aqui será exibida a imagem do tênis selecionado -->
        <img id="tenisImagem" src="">
        <p id="precoTenis"></p>
    </div>
</div>

<script>
    // Função para atualizar a imagem e o preço do tênis selecionado
    document.getElementById("tenis").addEventListener("change", function () {
        var tenisSelecionado = this.value;
        var imagemTenis = document.getElementById("tenisImagem");
        var precoTenis = document.getElementById("precoTenis");

        if (tenisSelecionado != "") {
            // Obtém a URL da imagem diretamente dos atributos "data-imagem" e "data-preco"
            var imagemURL = this.options[this.selectedIndex].getAttribute('data-imagem');
            var preco = this.options[this.selectedIndex].getAttribute('data-preco');

            // Exibe a imagem e o preço imediatamente
            imagemTenis.src = 'tenis/' + imagemURL;
            precoTenis.textContent = 'Preço: ' + preco + '€';

            // Mostra a imagem e o preço
            imagemTenis.style.display = 'block';
            precoTenis.style.display = 'block';
        } else {
            // Limpa a imagem e o preço se nenhum tênis for selecionado
            imagemTenis.src = "";
            precoTenis.textContent = "";

            // Esconde a imagem e o preço
            imagemTenis.style.display = 'none';
            precoTenis.style.display = 'none';
        }
    });
</script>

</body>
</html>

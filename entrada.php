<!DOCTYPE html>
<html>

<head>
<?php  
// Inclui o arquivo com a barra de navegação
require('navbar.php');
?>
</head>

<body>



<div class="hero-image">
    <div class="hero-text">
        <h1 style="font-size:50px">Sneakers Store</h1>
        <a href="produtos.php"><button>VER MAIS</button></a>
    </div>
</div>
<br>
<h1 style="margin-left: 60px;">Nossos Produtos</h1>
<div class="product-cards">
    
    <?php

    // Consultar os produtos na tabela "tenis"
    $sql = "SELECT * FROM tenis";
    $result = $con->query($sql);

    // Exibir os cards dos produtos
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '<a href="produtos.php"><img src="tenis/'. $row['img'] .'" alt="' . $row['nome_tenis'] . '" style="width:100%"></a>';
            echo '<div class="container">';
            echo '<h4><b>' . $row['nome_tenis'] . '</b></h4>';
            echo '<p>Marca: ' . $row['marca'] . '</p>';
            echo '<p>Preço: ' . $row['preco'] . '€</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Nenhum produto encontrado.";
    }


    ?>
</div>

</body>

</html>

<style>

.product-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .card {
            width: 300px;
            margin: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 350px;
            height: 350px;
        }

        .container {
            padding: 16px;
            height: auto;
        }

        h4 {
            margin: 0;
        }

        p {
            margin: 5px 0;
        }
    </style>

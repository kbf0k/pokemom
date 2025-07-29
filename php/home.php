<?php
include_once('conexao.php');

$sql_buscar = $conn->prepare("SELECT * FROM pokemons");
$sql_buscar->execute();
$result_buscar = $sql_buscar->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Listar pokemom</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="cadastrar.php">Cadastrar</a></li>
                <li><a href="listarYago.php">Relatório</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="pesquisa">
                <h1>Pesquisar Pokémom</h1>
                <input type="search" id="search" list="pokemom" placeholder="Digite o nome do pokémom">
            </div>

            <div id="resultado" style="display: none;"></div>

            <div id="lista_geral" class="card_container">
                <?php if ($result_buscar->num_rows > 0) {
                    while ($usuario = $result_buscar->fetch_assoc()) {
                        echo "<div class='card'>";
                        echo "<h1>" . strtoupper(htmlspecialchars($usuario['nome'])) . "</h1>";
                        echo "<img id='foto' src='" . htmlspecialchars($usuario['foto']) . "' alt='Foto' width='80'>";
                        echo "<p><strong>Tipo:</strong> <span>" . strtoupper(htmlspecialchars($usuario['tipo'])) . "</span></p>";
                        echo "<p><strong>Localização:</strong> <span>" . strtoupper(htmlspecialchars($usuario['localizacao'])) . "</span></p>";
                        echo "<p><strong>Data de registro:</strong> <span>" . strtoupper(htmlspecialchars($usuario['data_registro'])) . "</span></p>";
                        echo "<p><strong>HP:</strong> <span>" . strtoupper(htmlspecialchars($usuario['hp'])) . "</span></p>";
                        echo "<p><strong>Ataque:</strong> <span>" . strtoupper(htmlspecialchars($usuario['ataque'])) . "</span></p>";
                        echo "<p><strong>Defesa:</strong> <span>" . strtoupper(htmlspecialchars($usuario['defesa'])) . "</span></p>";
                        echo "<p><strong>Observações:</strong> <span>" . strtoupper(htmlspecialchars($usuario['observacoes'])) . "</span></p>";
                        echo "</div>";
                    }
                } ?>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $("#search").on("input", function() {
                var query = $(this).val();
                if (query.length > 0) {
                    $("#lista_geral").hide();
                    $.ajax({
                        url: "buscar_pokemon.php",
                        method: "POST",
                        data: {
                            search: query
                        },
                        success: function(data) {
                            $("#resultado").html(data).show();
                        }
                    });
                } else {
                    $("#resultado").hide();
                    $("#lista_geral").show();
                }
            });
        });
    </script>
</body>

</html>
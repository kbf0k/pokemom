<!-- Kaique Bernardes Ferreira e Yago Roberto Gomes Moraes Nº 15 e 31 -->
<?php
include('conexao.php');

if (isset($_POST['search'])) {
    $search = "%" . $_POST["search"] . "%";
    $sql = $conn->prepare("SELECT * FROM pokemons WHERE nome LIKE ? ");
    $sql->bind_param('s', $search);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='card_container'>";
        while ($usuario = $result->fetch_assoc()) {
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
        echo "</div>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Pokemon não encontrada',
                    text: 'Verifique o nome do Pokemon e tente novamente',
                    confirmButtonColor: '#3085d6'
                });
              </script>";
    }
}

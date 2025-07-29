<!-- Kaique Bernardes Ferreira e Yago Roberto Gomes Moraes Nº 15 e 31 -->
<?php
session_start();
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca o nome da imagem antes de excluir
    $stmt = $conn->prepare("SELECT foto FROM pokemons WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imagem);
    $stmt->fetch();
    $stmt->close();

    // Exclui o registro
    $stmt = $conn->prepare("DELETE FROM pokemons WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Remove a imagem se existir
    if ($imagem && file_exists("../fotos/" . $imagem)) {
        unlink("../fotos/" . $imagem);
    }

    $_SESSION['excluido'] = true;
    header("Location: ./listar_pokemon.php");
    exit();
} else {
    echo "ID não fornecido.";
}
?>

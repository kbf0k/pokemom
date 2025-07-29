<!-- Kaique Bernardes Ferreira e Yago Roberto Gomes Moraes Nº 15 e 31 -->
<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Atualizar os dados
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $localizacao = $_POST['localizacao'];
    $data = $_POST['data_registro'];
    $hp = $_POST['hp'];
    $ataque = $_POST['ataque'];
    $defesa = $_POST['defesa'];
    $observacoes = $_POST['observacoes'];
    $foto = trim($_POST['foto']); // Pode estar vazio

    if (!empty($foto)) {
        $sql = "UPDATE pokemons SET nome=?, tipo=?, localizacao=?, data_registro=?, hp=?, ataque=?, defesa=?, observacoes=?, foto=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiiissi", $nome, $tipo, $localizacao, $data, $hp, $ataque, $defesa, $observacoes, $foto, $id);
    } else {
        $sql = "UPDATE pokemons SET nome=?, tipo=?, localizacao=?, data_registro=?, hp=?, ataque=?, defesa=?, observacoes=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiiisi", $nome, $tipo, $localizacao, $data, $hp, $ataque, $defesa, $observacoes, $id);
    }

    if ($stmt->execute()) {
        $edicao_sucesso = true;
    } else {
        echo "Erro ao atualizar Pokémon.";
    }
} else {
    // Mostrar o formulário com os dados existentes
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM pokemons WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $pokemon = $resultado->fetch_assoc();
        } else {
            echo "Pokémon não encontrado.";
            exit();
        }
    } else {
        echo "ID não especificado.";
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Pokémon</title>
    <link rel="stylesheet" href="../css/cadastrar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" href="../img/pokebola.webp">

</head>

<?php
include "nav.php";
?>

<body>
    <div class="container">
        <h1>Editar Pokémon</h1>
        <form action="editar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $pokemon['id']; ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $pokemon['nome']; ?>" required>

            <label>Tipo:</label>
            <input type="text" name="tipo" value="<?php echo $pokemon['tipo']; ?>" required>

            <label>Localização:</label>
            <input type="text" name="localizacao" value="<?php echo $pokemon['localizacao']; ?>" required>

            <label>Data:</label>
            <input type="date" name="data_registro" value="<?php echo $pokemon['data_registro']; ?>" required>

            <label>HP:</label>
            <input type="number" name="hp" value="<?php echo $pokemon['hp']; ?>" required>

            <label>Ataque:</label>
            <input type="number" name="ataque" value="<?php echo $pokemon['ataque']; ?>" required>

            <label>Defesa:</label>
            <input type="number" name="defesa" value="<?php echo $pokemon['defesa']; ?>" required>

            <label>Observações:</label>
            <textarea name="observacoes"><?php echo $pokemon['observacoes']; ?></textarea>

            <label>Foto Atual:</label><br>
            <?php if ($pokemon['foto']): ?>
                <img src="<?php echo $pokemon['foto']; ?>" alt="Foto atual" width="100"><br>
            <?php endif; ?>

            <label>Novo link da foto (opcional):</label>
            <input type="text" name="foto" placeholder="https://...">

            <button type="submit">Salvar Alterações</button>
        </form>
        <br>
        <a href="listar_pokemon.php"><i class="fa-solid fa-arrow-left" style="margin-right: 4px;"></i> Voltar para a lista</a>
    </div>
</body>

<?php if (isset($edicao_sucesso) && $edicao_sucesso): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
  title: 'Sucesso!',
  text: 'Pokémon atualizado com sucesso!',
  icon: 'success',
  timer: 2000,
  showConfirmButton: false,
  timerProgressBar: true
}).then(() => {
  window.location.href = 'listar_pokemon.php';
});
</script>
<?php endif; ?>

</html>
<?php
include "conexao.php"; // conexão com banco

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pega os dados
    $nome = trim($_POST['nome']);
    $tipo = $_POST['tipo'];
    $localizacao = $_POST['localizacao'];
    $data = $_POST['data_registro'];
    $hp = $_POST['hp'];
    $ataque = $_POST['ataque'];
    $defesa = $_POST['defesa'];
    $observacoes = $_POST['observacoes'];


    $foto = ""; // Inicializa

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $pasta = 'fotos/';  // crie essa pasta com permissão de escrita!
        $nomeArquivo = uniqid() . '_' . basename($_FILES['foto']['name']);
        $destino = $pasta . $nomeArquivo;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
            $foto = $destino; // salva caminho para banco
        } else {
            $mensagem = "Falha ao enviar a foto.";
        }
    } else if (!empty($_POST['foto'])) {
        // Se não enviou arquivo, mas passou link no input foto (campo texto)
        $foto = $_POST['foto'];
    }

    if (empty($nome)) {
        $mensagem = "O nome do Pokémon é obrigatório.";
    } else {
        // Prepara e executa
        $stmt = $conn->prepare("INSERT INTO pokemons (nome, tipo, localizacao, data_registro, hp, ataque, defesa, observacoes, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiiiss", $nome, $tipo, $localizacao, $data, $hp, $ataque, $defesa, $observacoes, $foto);

        if ($stmt->execute()) {
            $mensagem = "✅ Pokémon cadastrado com sucesso!";
        } else {
            $mensagem = "❌ Erro ao cadastrar: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Pokémon Perdido</title>
    <link rel="stylesheet" href="../css/cadastrar.css">
    <link rel="icon" href="../img/pokebola.webp">
</head>

<body>
    <div class="container">
        <h1>Registrar Pokémon Perdido</h1>

        <?php if (!empty($mensagem)): ?>
            <div class="mensagem"><?php echo $mensagem; ?></div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <label>Nome: <input type="text" name="nome" required></label>

            <label>Tipo: <input type="text" name="tipo" required></label>

            <label>Localização Encontrada: <input type="text" name="localizacao"></label>

            <label>Data do Registro: <input type="date" name="data_registro"></label>

            <label>HP: <input type="number" name="hp" min="0"></label>

            <label>Ataque: <input type="number" name="ataque" min="0"></label>

            <label>Defesa: <input type="number" name="defesa" min="0"></label>

            <label>Observações:
                <textarea name="observacoes" rows="3" placeholder="Comportamento, condição..."></textarea>
            </label>

            <label>Foto (upload ou link):
                <input type="file" name="foto" accept="image/*">
                <br>OU<br>
                <input type="text" name="foto" placeholder="Coloque link da imagem">
            </label>
            <button type="submit">Cadastrar Pokémon</button>
        </form>
    </div>
</body>

</html>
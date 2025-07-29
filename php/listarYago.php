<?php
include "conexao.php";

$sql = "SELECT * FROM pokemons ORDER BY data_registro DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lista de Pokémons Encontrados</title>
  <link rel="stylesheet" href="../css/listarYago.css">
  <link rel="icon" href="../img/pokebola.webp">
</head>
<body>
  <div class="container">
    <h1>Pokémons Encontrados</h1>

    <?php if ($result->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Localização</th>
            <th>Data</th>
            <th>HP</th>
            <th>Ataque</th>
            <th>Defesa</th>
            <th>Foto</th>
            <th>Observações</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['nome']); ?></td>
              <td><?php echo htmlspecialchars($row['tipo']); ?></td>
              <td><?php echo htmlspecialchars($row['localizacao']); ?></td>
              <td><?php echo htmlspecialchars($row['data_registro']); ?></td>
              <td><?php echo $row['hp']; ?></td>
              <td><?php echo $row['ataque']; ?></td>
              <td><?php echo $row['defesa']; ?></td>
              <td>
                <?php if ($row['foto']): ?>
                  <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto" width="80">

                <?php endif; ?>
              </td>
              <td><?php echo nl2br(htmlspecialchars($row['observacoes'])); ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>Nenhum Pokémon registrado ainda.</p>
    <?php endif; ?>

    <a class="btn" href="cadastrar.php">← Voltar para cadastro</a>
  </div>
</body>
</html>

<?php $conn->close(); ?>

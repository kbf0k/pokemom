<!-- Kaique Bernardes Ferreira e Yago Roberto Gomes Moraes Nº 15 e 31 -->
<?php
include "conexao.php";

$sql = "SELECT * FROM pokemons ORDER BY data_registro DESC";
$result = $conn->query($sql);

if (isset($_GET['excluido'])): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Excluído com sucesso!',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php endif; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Pokémons Encontrados</title>
    <link rel="stylesheet" href="../css/listar_pokemon.css">
    <link rel="icon" href="../img/pokebola.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<?php
include "nav.php";
?>

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
                        <th>Ações</th> <!-- NOVO -->
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
                            <td>
                                <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn-acao editar" title="Editar">
                                    <i class="fa-solid fa-pen"></i> </a>

                                <a href="excluir.php?id=<?php echo $row['id']; ?>"
                                    class="btn-acao excluir"
                                    data-id="<?php echo $row['id']; ?>"
                                    title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </a>

                            </td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>

            </table>
        <?php else: ?>
            <p>Nenhum Pokémon registrado ainda.</p>
        <?php endif; ?>

        <a class="btn" href="cadastrar.php"><i class="fa-solid fa-arrow-left" style="margin-right: 10px;"></i>Voltar para cadastro</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-acao.excluir').forEach(function(botao) {
            botao.addEventListener('click', function(e) {
                e.preventDefault();
                const link = this.getAttribute('href');

                Swal.fire({
                    title: 'Tem certeza?',
                    text: 'Essa ação não poderá ser desfeita!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, excluir',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    }
                });
            });
        });
    </script>

</body>

</html>

<?php $conn->close(); ?>
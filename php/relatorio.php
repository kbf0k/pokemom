<!-- Kaique Bernardes Ferreira e Yago Roberto Gomes Moraes Nº 15 e 31 -->
<?php
include 'conexao.php';

// Consulta para contar quantos Pokémon há por tipo
$sql = "SELECT tipo, COUNT(*) AS quantidade FROM pokemons GROUP BY tipo";
$result = $conn->query($sql);

// Cria array com os dados
$tipos = [];
$quantidades = [];

while ($row = $result->fetch_assoc()) {
    $tipos[] = $row['tipo'];
    $quantidades[] = $row['quantidade'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Tipos de Pokémon</title>
    <link rel="icon" href="../img/pokebola.webp">
    <link rel="stylesheet" href="../css/listar_pokemon.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1B3B6F, #4A90E2, #00C6FB);
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            width: 50%;
            margin-bottom: 40px;
        }

        th,
        td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }

        canvas {
            display: block;
            margin: auto;
        }
    </style>
</head>

<?php
include "nav.php";
?>

<body>
    <div class="container">

        <h1>Relatório de Tipos de Pokémon</h1>

        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tipos as $index => $tipo): ?>
                    <tr>
                        <td><?= htmlspecialchars($tipo) ?></td>
                        <td><?= $quantidades[$index] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <canvas id="graficoTipos" width="400" height="400"></canvas>

        <script>
            const ctx = document.getElementById('graficoTipos').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($tipos) ?>,
                    datasets: [{
                        label: 'Quantidade por Tipo',
                        data: <?= json_encode($quantidades) ?>,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(213, 26, 26, 0.7)',
                            'rgba(35, 188, 40, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</body>

</html>
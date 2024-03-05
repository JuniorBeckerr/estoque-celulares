<?php
include_once('templates/header.php');
include_once('config/connection.php');

session_start();

// if (!isset($_SESSION['nome_usuario'])) {
//     header('Location: login.php');
//     exit;
// }
$sql = "SELECT * FROM Saidas ORDER BY DATA_SAIDA desc";
$stmt = $conn->query($sql);
$saidas = $stmt->fetch_All(MYSQLI_ASSOC);



?>

<section class="container">
    <h1>Saida</h1>
    <table>
        <thead>
            <tr>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>QUANTIDADE</th>
                <th>RESPONSAVEL</th>
                <th>OBSERVAÇÃO</th>               
                <th>SAIDA</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($saidas as $saida) : ?>
                <tr>
                    <td><?= $saida['marca']; ?></td>
                    <td><?= $saida['modelo']; ?></td>
                    <td><?= $saida['quantidade']; ?></td>
                    <td><?= $saida['responsavel']; ?></td>
                    <td><?= $saida['observacao']; ?></td>
                    <td><?= $saida['data_saida']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a class="register-input" href="outputregister.php">Cadastrar Saida</a>
</section>

<?php
include_once('templates/footer.php')
?>
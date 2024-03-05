<?php
include_once('templates/header.php');
include_once('config/connection.php');

session_start();

// if (!isset($_SESSION['nome_usuario'])) {
//     header('Location: login.php');
//     exit;
// }

$sql = "SELECT * FROM Entradas ORDER BY DATA_ENTRADA desc";
$result = $conn->query($sql);
$entrada = $result->fetch_all(MYSQLI_ASSOC);
?>

<section class="container">
    <h1>entrada</h1>
    <table>
        <thead>
            <tr>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>QUANTIDADE</th>
                <th>EMPRESA</th>
                <th>ESTADO</th>
                <th>OBSERVAÇÃO</th>
                <th>ENTRADA</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entrada as $item) : ?>
                <tr>
                    <td><?= $item['MARCA']; ?></td>
                    <td><?= $item['MODELO']; ?></td>
                    <td><?= $item['QUANTIDADE']; ?></td>
                    <td><?= $item['EMPRESA']; ?></td>
                    <td><?= $item['ESTADO']; ?></td>
                    <td><?= $item['OBSERVACAO']; ?></td>
                    <td><?= $item['DATA_ENTRADA']; ?></td>
                    <td>
                        <form action="<?= $BASE_URL ?>config/process.php" method="POST">
                            <input type="hidden" name="type" value="delete">
                            <input type="hidden" name="ID_ENTRADA" value="<?= $item['ID_ENTRADA'] ?>">
                            <button type="submit">X</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a class="register-input" href="register.php">Cadastrar Entrada</a>
</section>

<?php
include_once('templates/footer.php')
?>
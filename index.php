<?php
include_once('templates/header.php');
include_once('config/connection.php');

session_start();

// if (!isset($_SESSION['nome_usuario'])) {
//     header('Location: login.php');
//     exit;}

$sql = "SELECT * FROM estoque ORDER BY quantidade desc";
$stmt = $conn->query($sql);

$estoque = $stmt->fetch_all(MYSQLI_ASSOC);

?>


<section class="container">
    <h1>Estoque</h1>
    <table>
        <thead>
            <tr>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>QUANTIDADE</th>
                <th>ESTADO</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($estoque as $item) : ?>
                <tr>
                    <td><?= $item['marca']; ?></td>
                    <td><?= $item['modelo']; ?></td>
                    <td><?= $item['quantidade']; ?></td>
                    <td><?= $item['estado']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php
include_once('templates/footer.php')
?>
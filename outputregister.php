<?php
include_once('templates/header.php');
include_once('config/connection.php');


session_start();

// if (!isset($_SESSION['nome_usuario'])) {
//     header('Location: login.php');
//     exit;
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $quantidade = $_POST['quantidade'];
    $responsavel = $_POST['responsavel'];
    $observacao = $_POST['observacao'];
    $data_saida = $_POST['data_saida'];

    $sqlsaida = "INSERT INTO Saidas (marca, modelo, quantidade, responsavel, observacao, data_saida) 
                 VALUES (?, ?, ?, ?, ?, ?)";

    $stmtsaida = $conn->prepare($sqlsaida);
    $stmtsaida->bind_param("ssisss", $marca, $modelo, $quantidade, $responsavel, $observacao, $data_saida);

    if ($stmtsaida->execute()) {
        $atualizaEstoqueQuery = "UPDATE estoque SET quantidade = quantidade - ? 
        WHERE marca = ? AND modelo = ?";

        $stmtAtualizaEstoque = $conn->prepare($atualizaEstoqueQuery);
        $stmtAtualizaEstoque->bind_param("iss", $quantidade, $marca, $modelo);

        echo "Saida registrada com sucesso.";
    } else {
        echo "Erro ao registrar Saida: " . $stmtsaida->error;
    }

    $stmtsaida->close();
}


$sql = "SELECT * FROM estoque";
$stmt = $conn->query($sql);
$estoques = $stmt->fetch_All(MYSQLI_ASSOC);

?>

<section class="container">
    <h1>Registro de Saida</h1>
    <form action="outputregister.php" method="post">
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
                <tr>
                    <td>
                        <select id="marcaSelect" name="marca">
                            <?php foreach ($estoques as $item) : ?>
                                <option data-marca="<?= $item['marca'] ?>" data-estado="<?= $item['estado'] ?>">
                                    <?= $item['marca'] . ' - ' . $item['estado']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <select id="modeloSelect" name="modelo">
                            <?php
                            $modelosUnicos = array();

                            foreach ($estoques as $item) {
                                $marca = $item['marca'];
                                $modelo = $item['modelo'];
                                $estado = $item['estado'];

                                if (!isset($modelosUnicos[$marca][$modelo])) {
                                    echo "<option>";
                                    echo $marca . ' - ' . $modelo;
                                    echo "</option>";

                                    $modelosUnicos[$marca][$modelo] = true;
                                }
                            }
                            ?>
                    </td>
                    <td><input type="number" name="quantidade"></td>
                    <td><input type="text" name="responsavel"></td>
                    <td><input type="text" name="observacao"></td>
                    <td><input class="date-input" required type="date" name="data_saida" value="<?= date("Y-m-d"); ?>"> </td>

                </tr>
            </tbody>
        </table>
        <button class="register-input">Registrar Saida</button>
    </form>
</section>

<script>
    document.getElementById("marcaSelect").addEventListener("change", function() {
        var selectedOption = this.options[this.selectedIndex];
        var marca = selectedOption.getAttribute("data-marca");
        var estado = selectedOption.getAttribute("data-estado");

        console.log("Marca:", marca);
        console.log("Estado:", estado);

    });
</script>

<?php
include_once('templates/footer.php')
?>
<?php
include_once('templates/header.php');
include_once('config/connection.php');


session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST['estado'];
    $modelo = $_POST['marca-modelo'];
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
        $stmtAtualizaEstoque->execute();
        

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
    <h1>Registro de Saída</h1>
    <form action="outputregister.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>MARCA</th>
                    <th>MODELO</th>
                    <th>QUANTIDADE</th>
                    <th>RESPONSAVEL</th>
                    <th>OBSERVAÇÃO</th>
                    <th>SAÍDA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select id="marcaSelect" name="marca">
                            <?php
                            $marcasUnicas = [];
                            foreach ($estoques as $item) {
                                $marcasUnicas[$item['marca']] = true;
                            }

                            foreach ($marcasUnicas as $marca => $value) {
                                echo "<option value='$marca'>$marca</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select id="modeloSelect" name="modelo">
                        </select>
                    </td>
                    <td><input type="number" name="quantidade" required></td>
                    <td><input type="text" name="responsavel" required></td>
                    <td><input type="text" name="observacao"></td>
                    <td><input class="date-input" required type="date" name="data_saida" value="<?= date("Y-m-d"); ?>"> </td>
                </tr>
            </tbody>
        </table>
        <button class="register-input">Registrar Saída</button>
    </form>
</section>

<script>
    var estoques = <?php echo json_encode($estoques); ?>;

    document.getElementById("marcaSelect").addEventListener("change", function() {
        var marcaSelecionada = this.value;
        var modelos = estoques.filter(function(estoque) {
            return estoque.marca === marcaSelecionada;
        });

        var modeloSelect = document.getElementById("modeloSelect");
        modeloSelect.innerHTML = ''; 

        modelos.forEach(function(modelo) {
            var option = document.createElement("option");
            option.value = modelo.modelo;
            option.text = modelo.modelo + ' - ' + modelo.estado;
            modeloSelect.appendChild(option);
        });
    });

    document.getElementById("marcaSelect").dispatchEvent(new Event('change'));
</script>

<?php
include_once('templates/footer.php')
?>
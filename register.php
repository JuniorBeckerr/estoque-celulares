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
    $empresa = $_POST['empresa'];
    $estado = $_POST['estado'];
    $observacao = $_POST['observacao'];
    $data_entrada = $_POST['data_entrada'];
    $sqlEntrada = "INSERT INTO entradas (MARCA, MODELO, QUANTIDADE, EMPRESA, ESTADO, OBSERVACAO, DATA_ENTRADA) VALUES ('$marca','$modelo', $quantidade,'$empresa','$estado','$observacao','$data_entrada')";

    $sqlVerificaExistencia = "SELECT * FROM estoque WHERE marca = '$marca' AND modelo = '$modelo' AND estado = '$estado'";
    $resultado = $conn->query($sqlVerificaExistencia);

    if ($resultado->num_rows > 0) {
        $sqlAtualizaQuantidade = "UPDATE estoque SET quantidade = quantidade + $quantidade 
                                  WHERE marca = '$marca' AND modelo = '$modelo' AND estado = '$estado'";
        
        if ($conn->query($sqlAtualizaQuantidade) === TRUE) {
            echo "Quantidade atualizada com sucesso.";
        } else {
            echo "Erro ao atualizar a quantidade: " . $conn->error;
        }
    } else {
        $sqlEstoque = "INSERT INTO estoque (marca, modelo, quantidade, estado)
                       VALUES ('$marca', '$modelo', $quantidade, '$estado')";

        if ($conn->query($sqlEstoque) === TRUE) {
            echo "Entrada registrada no estoque com sucesso.";
        } else {
            echo "Erro ao registrar entrada no estoque: " . $conn->error;
        }
    }

    $sqlEntrada = "INSERT INTO entradas (MARCA, MODELO, QUANTIDADE, EMPRESA, ESTADO, OBSERVACAO, DATA_ENTRADA) 
                   VALUES ('$marca','$modelo', $quantidade,'$empresa','$estado','$observacao','$data_entrada')";

    if ($conn->query($sqlEntrada) === TRUE) {
        echo "Entrada registrada com sucesso.";
        header("location: entrada.php");
    } else {
        echo "Erro ao registrar entrada: " . $conn->error;
    }
}
?>

<section class="container">
    <h1>Registro de Entrada</h1>
    <form action="register.php" method="post">
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
                <tr>
                    <td><select name="marca" required>
                            <option value="" data-default disabled selected></option>
                            <option>SAMSUNG</option>
                            <option>MOTOROLA</option>
                            <option>LG</option>
                            <option>APPLE</option>
                            <option>BLU</option>
                        </select>
                    </td>
                    <td><select name="modelo" id="selectOpcao" required>
                            <option data-default disabled selected></option>
                            <option>A346</option>
                            <option>IPHONE 12</option>
                            <option>IPHONE 13</option>
                            <option>IPHONE 14</option>
                            <option>IPHONE 15</option>
                            <option>K9</option>
                            <option>MOTO E1</option>
                            <option>MOTO E40</option>
                            <option>MOTO G10</option>
                            <option>MOTO ONE</option>
                            <option>S21 Plus</option>
                            <option>S21</option>
                            <option>S23</option>
                            <option>S23 Ultra</option>

                    </td>
                    <td><input type="number" name="quantidade" required></td>
                    <td><select name="empresa" required>
                            <option data-default disabled selected></option>
                            <option>MTR</option>
                            <option>MCB</option>
                            <option>BP</option>
                            <option>PREA</option>
                            <option>CPRE</option>
                        </select>
                    </td>
                    <td><select name="estado" required>
                            <option data-default disabled selected></option>
                            <option>NOVO</option>
                            <option>USADO</option>
                            <option>QUEBRADO</option>
                        </select>
                    </td>
                    <td class="td-obs"><input type="text" name="observacao"></td>
                    <td><input class="date-input" required type="date" name="data_entrada" value="<?= date("d/m/Y"); ?>"></td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" name="type" value="entrada">
        <button type="submit" class="register-input">Registrar</button>
    </form>
</section>

<?php
include_once('templates/footer.php')
?>
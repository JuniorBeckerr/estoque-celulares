<?php
include_once("connection.php");
include_once("url.php");

$data = $_POST;

if ($data["type"] === "delete") {
    $id = $data["ID_ENTRADA"];
    $selectQuery = "SELECT * FROM entradas WHERE ID_ENTRADA = ?";
    $selectStmt = $conn->prepare($selectQuery);
    $selectStmt->bind_param("i", $id);
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    $entrada = $result->fetch_assoc();

    if ($entrada) {
        $quantidadeExcluida = $entrada['QUANTIDADE'];

        $deleteEntradaQuery = "DELETE FROM entradas WHERE ID_ENTRADA = ?";
        $deleteEntradaStmt = $conn->prepare($deleteEntradaQuery);
        $deleteEntradaStmt->bind_param("i", $id);

        try {
            $deleteEntradaStmt->execute();

            $updateEstoqueQuery = "UPDATE estoque 
                                   SET quantidade = (
                                       SELECT SUM(QUANTIDADE) 
                                       FROM entradas 
                                       WHERE MODELO = ? AND MARCA = ? AND ESTADO = ?
                                   )
                                   WHERE modelo = ? AND marca = ? AND estado = ?";
            $updateEstoqueStmt = $conn->prepare($updateEstoqueQuery);

            if (!$updateEstoqueStmt) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }

            $modelo = $entrada['MODELO'];
            $marca = $entrada['MARCA'];
            $estado = $entrada['ESTADO'];

            $updateEstoqueStmt->bind_param("ssssss", $modelo, $marca, $estado, $modelo, $marca, $estado);
            $updateEstoqueStmt->execute();

            if ($updateEstoqueStmt->errno) {
                die('Erro na execução da consulta: ' . $updateEstoqueStmt->error);
            }

            $verificarEstoqueQuery = "SELECT quantidade FROM estoque WHERE modelo = ? AND marca = ? AND estado = ?";
            $verificarEstoqueStmt = $conn->prepare($verificarEstoqueQuery);
            $verificarEstoqueStmt->bind_param("sss", $modelo, $marca, $estado);
            $verificarEstoqueStmt->execute();
            $verificarEstoqueStmt->store_result();

            if ($verificarEstoqueStmt->num_rows > 0) {
                $verificarEstoqueStmt->bind_result($quantidadeEstoque);
                $verificarEstoqueStmt->fetch();

                if ($quantidadeEstoque == 0) {
                    $excluirEstoqueQuery = "DELETE FROM estoque WHERE modelo = ? AND marca = ? AND estado = ?";
                    $excluirEstoqueStmt = $conn->prepare($excluirEstoqueQuery);
                    $excluirEstoqueStmt->bind_param("sss", $modelo, $marca, $estado);
                    $excluirEstoqueStmt->execute();
                    echo "Entrada excluída com sucesso e estoque atualizado e estoque removido, pois a quantidade ficou zero.";
                } else {
                    echo "Entrada excluída com sucesso e estoque atualizado.";
                }
            }
        } catch (mysqli_sql_exception $e) {
            $error = $e->getMessage();
            echo "Erro ao excluir entrada: $error";
        }
    } else {
        echo "Entrada não encontrada para exclusão.";
    }
}


header("Location: " . $BASE_URL . "../entrada.php");

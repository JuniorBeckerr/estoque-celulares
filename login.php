<!-- <?php
include_once("./config/connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeUsuario = $_POST['nome_usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT nome_usuario, senha FROM usuarios WHERE nome_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nomeUsuario]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && $senha) {
        $_SESSION['nome_usuario'] = $usuario['nome_usuario'];
        header('Location: index.php');
        exit;
    } else {
        $mensagemErro = 'Credenciais inválidas. Tente novamente.';
        echo "$mensagemErro";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

</head>

<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="nome_usuario">Nome de Usuário:</label>
        <input type="text" name="nome_usuario" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <button type="submit">Entrar</button>
    </form>


    <?php
    include_once "./templates/footer.php";
    ?> -->
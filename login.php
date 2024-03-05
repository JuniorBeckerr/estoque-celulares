<?php
include_once("./config/connection.php");
include_once("./config/url.php");

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
        <link rel="stylesheet" href="<?=$BASE_URL?>css/style-login.css">
        <title>Document</title>
    </head>
    <div class="container-img">
        <img src="https://lirp.cdn-website.com/d8dad59b/dms3rep/multi/opt/logo-mabu-dfd0999c-640w.png">
        </div>
    <body>
    <form action="login.php" method="post" class='container-login'>    
        <h2>Login</h2>

        <label for="nome_usuario">Nome de Usuário:
            <input type="text" name="nome_usuario" required>
        </label>

        <label for="senha">Senha:
            <input type="password" name="senha" required>
        </label>

        <button type="submit">Entrar</button>
    </form>
    <?php
    include_once "./templates/footer.php";
    ?>


<?php
session_start();

if (isset($_POST['submit-login']) && !empty($_POST['email']) && !empty($_POST['passwords'])) {
    include_once('config.php');

    $email = trim($_POST['email']);
    $password = trim($_POST['passwords']);

    // Usa prepared statement para evitar SQL Injection
    $sql = "SELECT * FROM usuarios WHERE email = ? AND passwords = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se encontrou um usuário com email e senha válidos
    if ($result->num_rows === 1) {
        $dados = $result->fetch_assoc();

        // Armazena informações na sessão
        $_SESSION['id'] = $dados['id'];           // chave primária
        $_SESSION['user'] = $dados['nome'];       // nome do usuário
        $_SESSION['email'] = $dados['email'];     // email (opcional)

        header('Location: /Telecurso-2000/home.php');
        exit();
    } else {
        // Login inválido
        session_unset();
        session_destroy();
        header('Location: /Telecurso-2000/login.php?erro=1');
        exit();
    }

    $stmt->close();
} else {
    // Campos vazios
    header('Location: /Telecurso-2000/login.php?erro=2');
    exit();
}
?>

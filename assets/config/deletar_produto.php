<?php
session_start();
include_once('config.php');

if (!isset($_SESSION['id'])) {
  header('Location: /Telecurso-2000/login.php');
  exit();
}

$id_usuario = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produto'])) {
  $id_produto = intval($_POST['id_produto']);

  // Apaga apenas se o produto for do usuário logado
  $sql = "DELETE FROM produtos WHERE id_produto = ? AND id = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("ii", $id_produto, $id_usuario);

  if ($stmt->execute()) {
    header('Location: /Telecurso-2000/products.php'); // ou home.php, como preferir
  } else {
    echo "Erro ao deletar: " . $stmt->error;
  }
}
?>

<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
header('Content-Type: application/json');

// Mostrar erros (remover em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['success' => false, 'message' => 'Requisição inválida.']);
  exit;
}

require_once 'config.php'; // conexão com o banco

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!isset($_SESSION['id'])) {
  echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
  exit;
}

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['carrinho']) || !is_array($data['carrinho'])) {
  echo json_encode(['success' => false, 'message' => 'Dados do carrinho inválidos.']);
  exit;
}

$id_usuario = $_SESSION['id'];
$data_venda = date('Y-m-d H:i:s');
$pedido = uniqid();

try {
  $conexao->begin_transaction();

  foreach ($data['carrinho'] as $item) {
    $nome = $item['nome'];
    $quantidade = (int)$item['quantidade'];
    $preco = (float)$item['preco'];
    $gasto = isset($item['gasto']) ? (float)$item['gasto'] : 0.00;
    $lucro = isset($item['lucro']) ? (float)$item['lucro'] : ($preco - $gasto) * $quantidade;

    $stmt = $conexao->prepare("INSERT INTO vendas_produtos (pedido, data_venda, produtos, quantVendida, preco, gasto, lucro, id_usuario)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssidddi", $pedido, $data_venda, $nome, $quantidade, $preco, $gasto, $lucro, $id_usuario);

    if (!$stmt->execute()) {
      throw new Exception("Erro ao salvar produto: " . $stmt->error);
    }
  }

  $conexao->commit();
  echo json_encode(['success' => true, 'message' => 'Venda registrada com sucesso.']);

} catch (Exception $e) {
  $conexao->rollback();
  echo json_encode(['success' => false, 'message' => 'Erro ao registrar venda: ' . $e->getMessage()]);
}

$conexao->close();
?>
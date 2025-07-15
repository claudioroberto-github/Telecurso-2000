<?php
session_start();
include_once('assets/config/config.php');

if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(["erro" => "Usuário não autenticado."]);
    exit;
}

$id_usuario = $_SESSION['id'];

$data_raw = file_get_contents('php://input');

$data = json_decode($data_raw, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(["erro" => "Erro ao decodificar JSON: " . json_last_error_msg()]);
    exit;
}

if (!is_array($data) || !isset($data['venda']) || !is_array($data['venda']) || empty($data['venda'])) {
    http_response_code(400);
    echo json_encode(["erro" => "JSON inválido ou vazio.", "conteudo" => $data]);
    exit;
}

$venda = $data['venda'];
$data_venda = date('Y-m-d H:i:s');

$query = "INSERT INTO vendas_produtos (data_venda, produtos, quantVendida, preco, gasto, lucro, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexao->prepare($query);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao preparar statement: " . $conexao->error]);
    exit;
}

$produto = '';
$quant = 0;
$preco = 0.0;
$gasto = 0.0;
$lucro = 0.0;

$stmt->bind_param("ssidddi", $data_venda, $produto, $quant, $preco, $gasto, $lucro, $id_usuario);

$sucesso = true;
$erros = [];
foreach ($venda as $item) {
    if (!isset($item['produto'], $item['quantVendida'], $item['preco'], $item['gasto'], $item['lucro'])) {
        $erros[] = ["item" => $item, "erro" => "Item malformado ou campos ausentes."];
        $sucesso = false;
        continue;
    }
    $produto = $item['produto'];
    $quant = intval($item['quantVendida']);
    $preco = floatval($item['preco']);
    $gasto = floatval($item['gasto']);
    $lucro = floatval($item['lucro']);
    if (!$stmt->execute()) {
        $erros[] = ["item" => $item, "erro" => $stmt->error];
        $sucesso = false;
    }
}
$stmt->close();

if ($sucesso) {
    echo json_encode(["sucesso" => true, "mensagem" => "Venda registrada com sucesso!"]);
} else {
    http_response_code(400);
    echo json_encode(["sucesso" => false, "mensagem" => "Alguns itens não foram salvos.", "erros" => $erros]);
}
?>

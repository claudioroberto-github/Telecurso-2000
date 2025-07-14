<?php
session_start();
include_once('config.php');

// Verifica login
if (!isset($_SESSION['id'])) {
    header('Location: /Telecurso%202000/login.php');
    exit();
}

$id_usuario = $_SESSION['id'];

// Verifica se o ID do produto foi passado
if (!isset($_GET['id_produto'])) {
    die('Produto não especificado.');
}

$id_produto = intval($_GET['id_produto']);

// Busca os dados do produto
$sql = "SELECT * FROM produtos WHERE id_produto = ? AND id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ii", $id_produto, $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die('Produto não encontrado ou não pertence a você.');
}

$produto = $result->fetch_assoc();

// Processa o formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_produto = trim($_POST['nome_produto']);
    $preco_produto = floatval(str_replace(',', '.', $_POST['preco_produto']));
    $classe_produto = trim($_POST['classe_produto']);
    $img_nova = $produto['img_produto']; // mantém imagem anterior por padrão

    // Verifica se nova imagem foi enviada corretamente
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $img_tmp = $_FILES['img']['tmp_name'];
        $img_nome = basename($_FILES['img']['name']);
        $uploads_dir = __DIR__ . '/../uploads/'; // Caminho absoluto correto

        // Garante que a pasta existe
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0755, true);
        }

        // Verifica se a pasta é gravável
        if (!is_writable($uploads_dir)) {
            die("A pasta 'uploads/' não tem permissão de escrita.");
        }

        // Gera nome único e seguro
        $img_nome_seguro = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '_', $img_nome);
        $img_destino = $uploads_dir . $img_nome_seguro;

        // Move o arquivo
        if (move_uploaded_file($img_tmp, $img_destino)) {
            // Remove imagem anterior se existir
            $caminho_antigo = __DIR__ . '/../' . $produto['img_produto'];
            if (!empty($produto['img_produto']) && file_exists($caminho_antigo)) {
                unlink($caminho_antigo);
            }

            // Caminho salvo no banco deve ser relativo a partir da raiz do projeto
            $img_nova = 'uploads/' . $img_nome_seguro;
        } else {
            echo "<p style='color:red;'>❌ Erro ao mover a imagem para a pasta 'uploads/'.</p>";
        }
    }

    // Atualiza o produto no banco
    $update_sql = "UPDATE produtos 
                   SET nome_produto = ?, preco_produto = ?, classe_produto = ?, img_produto = ?
                   WHERE id_produto = ? AND id = ?";
    $stmt = $conexao->prepare($update_sql);

    if (!$stmt) {
        die("Erro na preparação da query: " . $conexao->error);
    }

    $stmt->bind_param("sdssii", $nome_produto, $preco_produto, $classe_produto, $img_nova, $id_produto, $id_usuario);

    if ($stmt->execute()) {
        header('Location: /Telecurso-2000/products.php');
        exit();
    } else {
        echo "❌ Erro ao atualizar produto: " . $stmt->error;
    }
}

// Caminho da imagem para exibição no HTML
$img_path = __DIR__ . '/../' . $produto['img_produto'];
$img_url = (!empty($produto['img_produto']) && file_exists($img_path)) ? '/' . ltrim($produto['img_produto'], '/') : null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Editar Produto</title>
  <style>
    body {
      font-family: sans-serif;
      padding: 20px;
      background: #f4f4f4;
    }
    form {
      background: white;
      padding: 20px;
      border-radius: 12px;
      max-width: 500px;
      margin: auto;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }
    input, select {
      padding: 10px;
      font-size: 1rem;
    }
    img {
      max-width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 8px;
    }
    button {
      padding: 12px;
      background: #3D4859;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <h2 style="text-align:center;">Editar Produto</h2>

  <form method="POST" enctype="multipart/form-data">
    <label>Nome:</label>
    <input type="text" name="nome_produto" value="<?= htmlspecialchars($produto['nome_produto']) ?>" required />

    <label>Preço:</label>
    <input type="text" name="preco_produto" value="<?= htmlspecialchars(number_format($produto['preco_produto'], 2, ',', '')) ?>" required />

    <label>Categoria:</label>
    <select name="classe_produto" required>
      <option <?= $produto['classe_produto'] == "Entrada" ? "selected" : "" ?>>Entrada</option>
      <option <?= $produto['classe_produto'] == "Prato Principal" ? "selected" : "" ?>>Prato Principal</option>
      <option <?= $produto['classe_produto'] == "Sobremesa" ? "selected" : "" ?>>Sobremesa</option>
      <option <?= $produto['classe_produto'] == "Bebidas" ? "selected" : "" ?>>Bebidas</option>
      <option <?= $produto['classe_produto'] == "Bebidas alcoolicas" ? "selected" : "" ?>>Bebidas alcoolicas</option>
    </select>


    <label>Imagem Atual:</label>
    <?php
      $img_atual = $produto['img_produto'];
$img_nome = basename($img_atual); // apenas o nome do arquivo, sem diretórios

// Caminho físico absoluto no servidor
$img_fisico = __DIR__ . '/../assets/uploads/' . $img_nome;

// Caminho web (para <img src>)
$img_web = '/Telecurso-2000/assets/uploads/' . $img_nome;
    
    ?>
    <?php if (!empty($img_atual) && file_exists($img_fisico)): ?>
      <img src="<?= htmlspecialchars($img_web) ?>" alt="Imagem do Produto" />
    <?php else: ?>
      <p>Imagem não disponível</p>
    <?php endif; ?>

    <label>Nova imagem (opcional):</label>
    <input type="file" name="img" accept="image/*" />

    <button type="submit">Salvar Alterações</button>
    <button type="button" onclick="window.location.href='/Telecurso-2000/products.php'" style="margin-top: 4px; background-color: #c00; color: white;">Cancelar</button>
  </form>

</body>
</html>

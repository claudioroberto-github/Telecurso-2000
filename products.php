<?php
session_start();
include_once('assets/config/config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    session_unset();
    session_destroy();
    header('Location: /Telecurso%202000/login.php');
    exit();
}

$id_usuario = $_SESSION['id']; // chave primária do usuário logado

if (isset($_POST['add_product'])) {
    // Coleta os dados do formulário
    $nome_produto = trim($_POST['nome_produto']);
    $preco_produto = floatval($_POST['preco_produto']);
    $classe_produto = trim($_POST['classe_produto']);

    // Verifica se a imagem foi enviada corretamente
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $img_tmp = $_FILES['img']['tmp_name'];
        $img_nome = basename($_FILES['img']['name']);
        $img_destino = 'assets/uploads/' . uniqid() . '_' . $img_nome;

        // Verifica se a pasta tem permissão de escrita
        if (!is_writable('assets/uploads')) {
            die("A pasta 'assets/uploads/' não tem permissão de escrita.");
        }

        // Move o arquivo para a pasta uploads
        if (move_uploaded_file($img_tmp, $img_destino)) {
            // Prepara a query
            $sql = "INSERT INTO produtos (nome_produto, preco_produto, classe_produto, img_produto, id) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexao->prepare($sql);

            // Tratamento se prepare() falhar
            if (!$stmt) {
                die("Erro na preparação da query: " . $conexao->error);
            }

            // Faz o bind dos parâmetros
            $stmt->bind_param("sdssi", $nome_produto, $preco_produto, $classe_produto, $img_destino, $id_usuario);

            if ($stmt->execute()) {
                echo "<script>alert('✅ Produto cadastrado com sucesso!');</script>";
            } else {
                echo "<script>alert('❌ Erro ao cadastrar produto: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('❌ Erro ao mover a imagem para a pasta 'assets/uploads'.');</script>";
        }
    } else {
        echo "<script>alert('❌ Nenhuma imagem foi enviada ou ocorreu erro no upload.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sidebar Menu | CodingNepal</title>
  <link rel="stylesheet" href="assets/css/home/home.css " />
  <link rel="stylesheet" href="assets/css/menu/styles-loja.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
  <nav class="site-nav">
    <button class="sidebar-toggle">
      <span class="material-symbols-rounded">menu</span>
    </button>
  </nav>
  <!-- Sidebar -->
  <div class="container">
    <aside class="sidebar collapsed">
      <!-- Sidebar header -->
      <div class="sidebar-header">
        <img src="logo.png" alt="CodingNepal" class="header-logo" />
        <button class="sidebar-toggle">
          <span class="material-symbols-rounded">chevron_left</span>
        </button>
      </div>
      <div class="sidebar-content">
        <!-- Search Form -->
        <form action="#" class="search-form">
          <span class="material-symbols-rounded">search</span>
          <input type="search" placeholder="Search..." required />
        </form>
        <!-- Sidebar Menu -->
        <ul class="menu-list">
          <li class="menu-item">
            <a href="home.php" class="menu-link">
              <span class="material-symbols-rounded">home</span>
              <span class="menu-label">Home</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="menu.php" class="menu-link">
              <span class="material-symbols-rounded">Menu</span>
              <span class="menu-label">Menu</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded">notifications</span>
              <span class="menu-label">Notifications</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="menu.php" class="menu-link">
              <span class="material-symbols-rounded">star</span>
              <span class="menu-label">Favourites</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded">storefront</span>
              <span class="menu-label">Products</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded">group</span>
              <span class="menu-label">Customers</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded">settings</span>
              <span class="menu-label">Settings</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="assets/config/logOut.php" class="logout">
              <span class="material-symbols-rounded">logout</span>
              <span class="menu-label">Log Out</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- Sidebar Footer -->
      <div class="sidebar-footer">
        <button class="theme-toggle">
          <div class="theme-label">
            <span class="theme-icon material-symbols-rounded">dark_mode</span>
            <span class="theme-text">Dark Mode</span>
          </div>
          <div class="theme-toggle-track">
            <div class="theme-toggle-indicator"></div>
          </div>
        </button>
      </div>
    </aside>
    <!-- Main Content -->
    <main class="main-content" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 20px;">
      <button class="cart-button" id="cart-button">
        <span class="material-symbols-rounded">add</span>
      </button>
      <style>
        #product-form {
          background: #fff;
          border-radius: 16px;
          box-shadow: 0 2px 16px rgba(0, 0, 0, 0.10);
          padding: 32px 28px 24px 28px;
          display: flex;
          flex-direction: column;
          gap: 18px;
          min-width: 320px;
          max-width: 400px;
          margin: 0 auto;
          align-items: center;
        }

        #product-form .form-group {
          display: flex;
          flex-direction: column;
          gap: 14px;
          width: 100%;
        }

        #product-form input[type="text"],
        #product-form input[type="file"] {
          padding: 10px 12px;
          border: 1px solid #ccc;
          border-radius: 8px;
          font-size: 1rem;
          width: 100%;
          box-sizing: border-box;
        }

        #product-form input[type="file"] {
          background: #f9f9f9;
        }

        #product-form .fa-solid {
          color: #888;
          margin-left: 6px;
          margin-bottom: 8px;
        }

        #product-form .btn.btn-primary {
          background: #3D4859;
          color: #fff;
          border: none;
          border-radius: 8px;
          padding: 12px 0;
          font-size: 1.08rem;
          font-weight: 600;
          width: 100%;
          cursor: pointer;
          transition: background 0.2s;
        }

        #product-form .btn.btn-primary:hover {
          background: #222b38;
        }
      </style>

      <div class="cart-display" style="display: none; justify-content: center; align-items: center; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.18); z-index: 1000; margin: 0;">
        <form id="product-form" action="products.php" method="POST" enctype="multipart/form-data" style="position: relative;">
          <button class="close-cart" style="position: absolute; top: 10px; right: 10px; background: none; border: none; cursor: pointer; font-size: 1.6rem; color: #3D4859; z-index: 10;">
            <span class="material-symbols-rounded">close</span>
          </button>
          <div class="form-group">
            <input name="nome_produto" type="text" placeholder="Name of Product" required />
            <i class="fa-solid fa-user"></i>
            <input name="preco_produto" type="text" placeholder="Price" required />
            <i class="fa-solid fa-briefcase"></i>
            <!--<input name="cnpj" type="text" placeholder="" required />-->
            <label for="categoria">Choose a category(food, drink, etc.):</label>
            <select id="categoria" name="classe_produto" required>
              <option value="Entrada">Entrada</option>
              <option value="Prato Principal">Prato Principal</option>
              <option value="Sobremesa">Sobremesa</option>
              <option value="Bebidas">Bebidas</option>
              <option value="Bebidas alcoolicas">Bebidas alcoolicas</option>
            </select>
            <i class="fa-solid fa-list"></i>
            <i class="fa-solid fa-magnifying-glass-chart"></i>
            <input name="img" type="file" accept="image/*" required />
            <i class="fa-solid fa-image"></i>
          </div>
          <button type="submit" name="add_product" class="btn btn-primary">Add the Product</button>
        </form>
      </div>

      <div class="CRUD_products" style="display: flex; flex-wrap: wrap; gap: 20px; padding: 20px; justify-content: center; align-items: center;">
  <?php
  // Busca os produtos do usuário logado
  $query = "SELECT * FROM produtos WHERE id = ?";
  $stmt = $conexao->prepare($query);
  $stmt->bind_param("i", $id_usuario);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0):
  ?>
    <div style="width:100%;text-align:center;padding:40px 0;color:#3D4859;font-size:1.15rem;opacity:0.85;">
      <span style="font-size:2.2rem;display:block;margin-bottom:10px;">🛒</span>
      Não há produtos, adicione para começar suas vendas
    </div>
  <?php else:
    while ($row = $result->fetch_assoc()):
  ?>
    <div style="background: #fff; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 16px; width: 220px; text-align: center;">
      <?php
        $img_path = $row['img_produto'];
        // Se o caminho já começa com 'assets/uploads/', usa direto; senão, ajusta
        if (strpos($img_path, 'assets/uploads/') !== 0) {
          $img_path = 'assets/uploads/' . basename($img_path);
        }
      ?>
      <img src="<?= htmlspecialchars($img_path) ?>" alt="Produto" style="max-width: 100%; height: 120px; object-fit: cover; border-radius: 8px;">
      <h3 style="margin: 10px 0 5px;"><?= htmlspecialchars($row['nome_produto']) ?></h3>
      <p style="margin: 0; color: #444;">R$ <?= number_format($row['preco_produto'], 2, ',', '.') ?></p>
      <small style="color: #777;"><?= htmlspecialchars($row['classe_produto']) ?></small>

      <form action="assets/config/editar_produto.php" method="GET" style="margin-top: 10px;">
        <input type="hidden" name="id_produto" value="<?= $row['id_produto'] ?>">
        <button type="submit" class="btn-crud btn-edit">Editar</button>
      </form>

      <form action="assets/config/deletar_produto.php" method="POST" onsubmit="return confirm('Deseja realmente excluir este produto?');">
        <input type="hidden" name="id_produto" value="<?= $row['id_produto'] ?>">
        <button type="submit" class="btn-crud btn-delete">Excluir</button>
      </form>
    </div>
  <?php endwhile; endif; ?>
  
<style>
  .btn-crud {
    padding: 7px 16px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    box-shadow: 0 1px 6px rgba(61,72,89,0.08);
    cursor: pointer;
    transition: background 0.18s, color 0.18s, box-shadow 0.18s;
    margin: 4px 0 0 0;
    outline: none;
  }
  .btn-edit {
    background: #f4f7fa;
    color: #3D4859;
  }
  .btn-edit:hover {
    background: #e0e7ef;
    color: #222b38;
    box-shadow: 0 2px 10px rgba(61,72,89,0.12);
  }
  .btn-delete {
    background: #fbeaea;
    color: #c00;
    margin-top: 6px;
  }
  .btn-delete:hover {
    background: #f8d7da;
    color: #a00;
    box-shadow: 0 2px 10px rgba(192,0,0,0.12);
  }
</style>
</div>
    </main>
  </div>
  <!-- Scripts -->
  <script src="assets/js/home/home.js"></script>
  <script src="assets/js/menu/menu.js"></script>
</body>

</html>
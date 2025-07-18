<?php
session_start();
include_once('assets/config/config.php');
$id_usuario = $_SESSION['id']; // pega o id do usuário logado
// Buscar a imagem do usuário logado
$sql_img = "SELECT img FROM usuarios WHERE id = ?";
$stmt = $conexao->prepare($sql_img);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result_img = $stmt->get_result();
$imagem_usuario = 'assets/imgs/default_user.png'; // imagem padrão, se não tiver

if ($result_img && $row_img = $result_img->fetch_assoc()) {
    if (!empty($row_img['img'])) {
        $imagem_usuario = $row_img['img'];
    }
}


if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
  header('Location: /Telecurso-2000/login.php');
  unset($_SESSION['email']);
  unset($_SESSION['passwords']);
}
$logged = isset($_SESSION['user']) ? $_SESSION['user'] : '';
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bem-vindo <?php if (isset($_SESSION['user'])) echo '| ' . htmlspecialchars($_SESSION['user']); ?></title>
  <link rel="stylesheet" href="assets/css/home/home.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
  <nav class="site-nav">
    <button class="sidebar-toggle">
      <span class="material-symbols-rounded">menu</span>
    </button>
  </nav>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar collapsed">
      <!-- Sidebar header -->
      <div class="sidebar-header">
        <img src="<?php echo htmlspecialchars($imagem_usuario); ?>" alt="Foto do Usuário" class="header-logo" style="border-radius: 50%; width: 40px; height: 40px;" />
        <button class="sidebar-toggle">
          <span class="material-symbols-rounded">chevron_left</span>
        </button>
      </div>
      <div class="sidebar-content">
        <p class="user-name">Welcome <b><?php echo htmlspecialchars($logged); ?></b></p>
        <!-- Search Form -->
        <form action="#" class="search-form">
          <span class="material-symbols-rounded">search</span>
          <input type="search" placeholder="Search..." required />
        </form>
        <!-- Sidebar Menu -->
        <ul class="menu-list">

          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded">home</span>
              <span class="menu-label">Home</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="menu.php" class="menu-link">
              <span class="material-symbols-rounded">room_service</span>
              <span class="menu-label">Menu</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="products.php" class="menu-link">
              <span class="material-symbols-rounded" aria-label="Products">storefront</span>
              <span class="menu-label">Products</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded">notifications</span>
              <span class="menu-label">Notifications</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded">star</span>
              <span class="menu-label">Favourites</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded">group</span>
              <span class="menu-label">Customers</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="settings.php" class="menu-link">
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
    <main>
      <h1>Vendas do Mês</h1>
      <style>
  .table-wrapper {
    width: 100%;
    margin-top: 24px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    position: relative;
  }

  table.vendas-mes {
    width: 100%;
    border-collapse: collapse;
    font-size: 1rem;
    background: #fff;
    table-layout: fixed;
  }

  table.vendas-mes th,
  table.vendas-mes td {
    padding: 14px 10px;
    text-align: center;
    border-bottom: 1px solid #eee;
  }

  table.vendas-mes thead th {
    background: #f5f5f5;
    font-weight: 700;
    font-size: 1.08rem;
    position: sticky;
    top: 0;
    z-index: 2;
  }

  .tbody-scroll {
    max-height: 340px;
    overflow-y: auto;
  }

  .tbody-scroll table {
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
  }

  .tbody-scroll tbody tr:nth-child(even) {
    background: #fafafa;
  }

  .tbody-scroll tbody tr:nth-child(odd) {
    background: #fff;
  }

  .tbody-scroll::-webkit-scrollbar {
    width: 10px;
    background: #ececec;
  }

  .tbody-scroll::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 12px;
  }

  .tbody-scroll {
    scrollbar-width: thin;
    scrollbar-color: #ccc #ececec;
  }

  table.vendas-mes tfoot td {
    background: #f5f5f5;
    font-weight: bold;
    font-size: 1.05rem;
  }

  tfoot.sticky-total tr td {
    position: sticky;
    bottom: 0;
    background: #f5f5f5;
    z-index: 1;
    border-top: 2px solid #e0e0e0;
  }

  table.vendas-mes th:nth-child(1),
  table.vendas-mes td:nth-child(1) {
    width: 18%;
  }

  table.vendas-mes th:nth-child(2),
  table.vendas-mes td:nth-child(2) {
    width: 26%;
    text-align: center;
  }

  table.vendas-mes th:nth-child(3),
  table.vendas-mes td:nth-child(3),
  table.vendas-mes th:nth-child(4),
  table.vendas-mes td:nth-child(4),
  table.vendas-mes th:nth-child(5),
  table.vendas-mes td:nth-child(5),
  table.vendas-mes th:nth-child(6),
  table.vendas-mes td:nth-child(6) {
    width: 14%;
  }

  a {
    color: #333;
    text-decoration: none;
    font-weight: 500;
  }

  a:hover {
    text-decoration: underline;
  }
</style>

      <div class="table-wrapper">
  <table class="vendas-mes">
    <thead>
      <tr>
        <th>Pedido</th>
        <th>Data da Venda</th>
        <th>Produto</th>
        <th>Quantidade Vendida</th>
        <th>Preço (R$)</th>
      </tr>
    </thead>
  </table>

  <div class="tbody-scroll">
    <table class="vendas-mes">
      <tbody>
        <?php
        $sql = "SELECT pedido, data_venda, produtos, quantVendida, preco FROM vendas_produtos WHERE id_usuario = $id_usuario ORDER BY data_venda DESC";
        $stmt = $conexao->prepare("SELECT pedido, data_venda, produtos, quantVendida, preco FROM vendas_produtos WHERE id_usuario = ? ORDER BY data_venda DESC");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();


        $totalPreco = 0;

        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $totalPreco += $row['preco'] * $row['quantVendida'];

            echo "<tr>
              <td>{$row['pedido']}</td>
              <td>" . htmlspecialchars($row['data_venda']) . "</td>
              <td>" . htmlspecialchars($row['produtos']) . "</td>
              <td>{$row['quantVendida']}</td>
              <td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>
            </tr>";
          }
        } else {
          echo "<tr><td colspan='6'>Nenhuma venda registrada.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <table class="vendas-mes">
    <tfoot class="sticky-total">
      <tr>
        <td></td>
        <td><strong>Total</strong></td>
        <td></td>
        <td><strong>R$ <?php echo number_format($totalPreco, 2, ',', '.'); ?></strong></td>
      </tr>
    </tfoot>
  </table>
</div>
    </main>
  </div>
  <script src="assets/js/home/home.js"></script>
</body>

</html>
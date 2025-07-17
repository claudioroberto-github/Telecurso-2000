<?php 


session_start();
include_once('assets/config/config.php');

if (!isset($_SESSION['user']) || !isset($_SESSION['id'])) {
  session_unset();
  session_destroy();
  header('Location: /Telecurso-2000/login.php');
  exit();
}
$logged = $_SESSION['user'];
$id_usuario = $_SESSION['id'];
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
        <button class="sidebar-toggle">
          <span class="material-symbols-rounded">chevron_left</span>
        </button>
      </div>
      <div class="sidebar-content">
        <?php echo '<p class="user-name">Welcome <b>' . htmlspecialchars($logged) . '</b></p>'; ?>
        <!-- Search Form -->
        <form action="#" class="search-form">
          <span class="material-symbols-rounded">search</span>
          <input type="search" placeholder="Search..." required />
        </form>
        <!-- Sidebar Menu -->
        <ul class="menu-list">
          <li class="menu-item">
            <a href="home.php" class="menu-link">
              <span class="material-symbols-rounded" aria-label="Home">home</span>
              <span class="menu-label">Home</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded" aria-label="Menu">room_service</span>
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
              <span class="material-symbols-rounded" aria-label="Notifications">notifications</span>
              <span class="menu-label">Notifications</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded" aria-label="Favourites">star</span>
              <span class="menu-label">Favourites</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded" aria-label="Customers">group</span>
              <span class="menu-label">Customers</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded" aria-label="Settings">settings</span>
              <span class="menu-label">Settings</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="assets/config/logOut.php" class="logout">
              <span class="material-symbols-rounded" aria-label="Log Out">logout</span>
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
    <!-- Site main content -->
    <main class="main-content">
      <div class="topics" style="display: flex; align-items: center;justify-content:center ; padding: 40px; position: fixed; background: #fdfdfd; width: 60%; height: 60px; top: 0;">
        <button class="cart-button" id="cart-button">
          <span class="material-symbols-rounded">shopping_cart</span>
        </button>
        <a href="#title-posters1" style="margin-left: 20px;">comidas</a>
        <a href="#title-posters2" style="margin-left: 20px;">bebidas</a>
      </div>


      <style>
        .products {
          width: 100%;
          min-height: 75vh;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: flex-start;
          background: #f7f9fb;
          padding: 48px 0 32px 0;
          border-radius: 18px;
          box-shadow: 0 2px 16px rgba(61,72,89,0.07);
          margin-top: 80px;
        }
        .products-container {
          display: flex;
          flex-wrap: wrap;
          gap: 32px;
          justify-content: center;
          width: 100%;
          max-width: 1200px;
          margin: 0 auto;
        }
        .movie-product {
          background: #fff;
          border-radius: 16px;
          box-shadow: 0 2px 12px rgba(61,72,89,0.10);
          border: 1.5px solid #e6eaf0;
          padding: 24px 18px 18px 18px;
          min-width: 240px;
          max-width: 260px;
          margin-bottom: 18px;
          display: flex;
          flex-direction: column;
          align-items: center;
          transition: box-shadow 0.18s, transform 0.18s, border 0.18s;
          position: relative;
        }
        .movie-product:hover {
          box-shadow: 0 8px 32px rgba(61,72,89,0.18);
          border: 1.5px solid #b6c2d1;
          transform: translateY(-6px) scale(1.035);
        }
        .movie-product .product-title {
          font-size: 1.18rem;
          font-weight: 700;
          color: #2d3542;
          margin-bottom: 10px;
          text-align: center;
        }
        .movie-product .product-image {
          width: 100%;
          max-width: 180px;
          height: 140px;
          object-fit: cover;
          border-radius: 10px;
          margin-bottom: 14px;
          box-shadow: 0 1px 6px rgba(61,72,89,0.07);
        }
        .movie-product .product-price-container {
          display: flex;
          align-items: center;
          justify-content: space-between;
          width: 100%;
          margin-top: 10px;
        }
        .movie-product .product-price {
          font-size: 1.08rem;
          font-weight: 600;
          color: #3D4859;
        }
        .movie-product .button-hover-background {
          background: #f4f7fa;
          border: none;
          border-radius: 8px;
          padding: 8px 12px;
          cursor: pointer;
          transition: background 0.18s, color 0.18s;
          color: #3D4859;
          font-size: 1.2rem;
          margin-left: 8px;
        }
        .movie-product .button-hover-background:hover {
          background: #e0e7ef;
          color: #222b38;
        }
        @media (max-width: 900px) {
          .products-container {
            max-width: 98vw;
            gap: 18px;
          }
          .products {
            padding: 32px 0 18px 0;
          }
        }
        @media (max-width: 600px) {
          .products {
            padding: 16px 0 8px 0;
            border-radius: 0;
            margin-top: 60px;
          }
          .products-container {
            gap: 10px;
          }
        }
      </style>
      <div class="products">
        <section class="container normal-section" style="display: flex; flex-direction: column; align-items: center;">
  <h2 class="section-title" id="title-posters1">Produtos</h2>
  <div class="products-container" style="gap: 32px; justify-content: center; flex-wrap: wrap;">
    <?php

    $query = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()):
      $nome = htmlspecialchars($row['nome_produto']);
      $preco = number_format($row['preco_produto'], 2, ',', '.');
      $img = $row['img_produto'] ?? 'assets/img/placeholder.png';

      // Caminho correto da imagem
      if (strpos($img, 'uploads/') === 0) {
        $img_path = "assets/" . $img;
      } elseif (strpos($img, 'assets/') === 0) {
        $img_path = $img;
      } else {
        $img_path = "assets/img/" . $img;
      }
    ?>
      <div class="movie-product" style="box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-radius: 12px; padding: 20px; background: #fff; min-width: 260px; max-width: 260px; margin-bottom: 16px;">
        <strong class="product-title"><?= $nome ?></strong>
        <img src="<?= $img_path ?>" alt="<?= $nome ?>" class="product-image" style="border-radius: 8px; margin-bottom: 10px; max-height: 160px; object-fit: cover;">
        <div class="product-price-container">
          <span class="product-price">R$<?= $preco ?></span>
          <button type="button" class="button-hover-background">
            <span class="material-symbols-rounded">add_shopping_cart</span>
          </button>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>

      </div>
      <div class="cart-display" style="display: none; justify-content: center; align-items: center; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.18); z-index: 1000; margin: 0;">
        <section class="container normal-section" style="box-shadow: 0 4px 24px rgba(0,0,0,0.18); border-radius: 18px; background: #fff; padding: 32px 24px; display: flex; flex-direction: column; width: 90vw; max-width: 600px; min-width: 260px; max-height: 80vh; overflow-y: auto; align-items: center;">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <h2 class="section-title" style="margin-bottom: 0;">Carrinho</h2>
            <button class="close-cart" style="background: none; border: none; cursor: pointer;">
              <span class="material-symbols-rounded">close</span>
            </button>
          </div>
          <table class="cart-table" style="width: 100%; display: table; border-collapse: collapse; margin-bottom: 16px; overflow-y: auto; justify-content: center; align-items: center;">
            <thead style="background: #f5f5f5;">
              <tr>
                <th class="table-head-item first-col" style="padding: 12px 8px; border-bottom: 2px solid #ececec; text-align: left; font-weight: 600;">Item</th>
                <th class="table-head-item second-col" style="padding: 12px 8px; border-bottom: 2px solid #ececec; text-align: center; font-weight: 600;">Preço</th>
                <th class="table-head-item third-col" style="padding: 12px 8px; border-bottom: 2px solid #ececec; text-align: center; font-weight: 600;">Quantidade</th>
              </tr>
            </thead>
            <tbody id="cart-table-body">
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="cart-total-container" style="padding: 16px 8px; border-top: 2px solid #ececec; text-align: right; font-size: 1.1rem; background: #fafafa; font-weight: 600;">
                  <strong style="margin-right: 12px;">Total</strong>
                  <span>R$0,00</span>
                </td>
              </tr>
            </tfoot>
          </table>
          <button type="button" id="finalizar" class="purchase-button" style="margin-top: 24px;">Finalizar Compra</button>
        </section>
      </div>


    </main>
    <style>
      .cart-display::-webkit-scrollbar {
        width: 10px;
        border-radius: 18px;
        background: #ececec;
      }
      .cart-display::-webkit-scrollbar-thumb {
        background: #d1d1d1;
        border-radius: 18px;
      }
      .cart-display {
        scrollbar-width: thin;
        scrollbar-color: #d1d1d1 #ececec;
        border-radius: 18px;
      }
    </style>
    <script src="assets/js/menu/menu.js"></script>
    <script src="assets/js/menu/finalizar_compra.js"></script>
    <script src="assets/js/home/home.js"></script>

      <script>
        document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('finalizar');
  if (btn) {
    btn.addEventListener('click', makePurchase);
  }
});

</script>
>>>>>>> e6b6af8 (consegui arrumar o menu de vendas com o banco de dados)
</body>
</html>
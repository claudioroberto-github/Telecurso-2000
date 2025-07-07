<?php

session_start();
include_once('assets/config/config.php');
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
  header('Location: /Telecurso 2000/login.php');
  unset($_SESSION['email']);
  unset($_SESSION['passwords']);
}
$logged = $_SESSION['user'];

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
              <span class="material-symbols-rounded">home</span>
              <span class="menu-label">Home</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
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
            <a href="#" class="menu-link">
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
    <!-- Site main content -->
    <main class="main-content">
      <div class="topics" style="display: flex; align-items: center;justify-content:center ; padding: 40px; position: fixed; background: #fdfdfd; width: 60%; height: 60px; top: 0;">
        <button class="cart-button" id="cart-button">
          <span class="material-symbols-rounded">shopping_cart</span>
        </button>
        <a href="#title-posters1" style="margin-left: 20px;">comidas</a>
        <a href="#title-posters2" style="margin-left: 20px;">bebidas</a>
      </div>


      <div class="produ+cts">
        <section class="container normal-section" style="display: flex; flex-direction: column; align-items: center;">
          <h2 class="section-title" id="title-posters1">Posters</h2>
          <div class="products-container" style="gap: 32px; justify-content: center;">
            <div class="movie-product" style="box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-radius: 12px; padding: 20px; background: #fff; min-width: 260px; max-width: 260px; margin-bottom: 16px;">
              <strong class="product-title">Poster 1</strong>
              <img src="assets/img/plate1.png" alt="Poster 1" class="product-image" style="border-radius: 8px; margin-bottom: 10px;">
              <div class="product-price-container">
                <span class="product-price">R$29,99</span>
                <button type="button" class="button-hover-background"><span class="material-symbols-rounded">add_shopping_cart</span></button>
              </div>
            </div>
            <div class="movie-product" style="box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-radius: 12px; padding: 20px; background: #fff; min-width: 260px; max-width: 260px; margin-bottom: 16px;">
              <strong class="product-title">Poster 2</strong>
              <img src="assets/img/plate1.png" alt="Poster 2" class="product-image" style="border-radius: 8px; margin-bottom: 10px;">
              <div class="product-price-container">
                <span class="product-price">R$39,99</span>
                <button type="button" class="button-hover-background"><span class="material-symbols-rounded">add_shopping_cart</span></button>
              </div>
            </div>
            <div class="movie-product" style="box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-radius: 12px; padding: 20px; background: #fff; min-width: 260px; max-width: 260px; margin-bottom: 16px;">
              <strong class="product-title">Poster 3</strong>
              <img src="assets/img/plate1.png" alt="Poster 3" class="product-image" style="border-radius: 8px; margin-bottom: 10px;">
              <div class="product-price-container">
                <span class="product-price">R$19,99</span>
                <button type="button" class="button-hover-background"><span class="material-symbols-rounded">add_shopping_cart</span></button>
              </div>
            </div>
            <div class="movie-product" style="box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-radius: 12px; padding: 20px; background: #fff; min-width: 260px; max-width: 260px; margin-bottom: 16px;">
              <strong class="product-title">Poster 4</strong>
              <img src="assets/img/plate1.png" alt="Poster 4" class="product-image" style="border-radius: 8px; margin-bottom: 10px;">
              <div class="product-price-container">
                <span class="product-price">R$79,99</span>
                <button type="button" class="button-hover-background"><span class="material-symbols-rounded">add_shopping_cart</span></button>
              </div>
            </div>
          </div>
        </section>
        <section class="container normal-section">
          <h2 class="section-title" id="title-posters2">Produtos</h2>
          <div class="products-container" style="gap: 32px; justify-content: center;">
            <div class="movie-product" style="box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-radius: 12px; padding: 20px; background: #fff; min-width: 260px; max-width: 260px; margin-bottom: 16px;">
              <strong class="product-title">Camiseta</strong>
              <img src="assets/img/plate1.png" alt="Camiseta" class="product-image" style="border-radius: 8px; margin-bottom: 10px;">
              <div class="product-price-container">
                <span class="product-price">R$39,90</span>
                <button type="button" class="button-hover-background"><span class="material-symbols-rounded">add_shopping_cart</span></button>
              </div>
            </div>
            <div class="movie-product" style="box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-radius: 12px; padding: 20px; background: #fff; min-width: 260px; max-width: 260px; margin-bottom: 16px;">
              <strong class="product-title">Miniatura</strong>
              <img src="assets/img/plate1.png" alt="Miniatura" class="product-image" style="border-radius: 8px; margin-bottom: 10px;">
              <div class="product-price-container">
                <span class="product-price">R$69,90</span>
                <button type="button" class="button-hover-background"><span class="material-symbols-rounded">add_shopping_cart</span></button>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="cart-display" style="display: none; justify-content: center; align-items: center; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.18); z-index: 1000; margin: 0;">
        <section class="container normal-section" style="box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-radius: 12px; background: #fff; padding: 24px; display: flex; flex-direction: column; width: 100%; max-width: 700px; min-width: 320px; max-height: 500px; overflow-y: auto;">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <h2 class="section-title" style="margin-bottom: 0;">Carrinho</h2>
            <button class="close-cart" style="background: none; border: none; cursor: pointer;">
              <span class="material-symbols-rounded">close</span>
            </button>
          </div>
          <table class="cart-table" style="width: 100%; display: table; border-collapse: collapse; margin-bottom: 16px; overflow-y: auto; justify-content: center; align-items: center;">
            <thead>
              <tr>
                <th class="table-head-item first-col">Item</th>
                <th class="table-head-item second-col">Preço</th>
                <th class="table-head-item third-col">Quantidade</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="cart-total-container">
                  <strong>Total</strong>
                  <span>R$0,00</span>
                </td>
              </tr>
            </tfoot>
          </table>
          <button type="button" class="purchase-button" style="margin-top: 24px;">Finalizar Compra</button>
        </section>
      </div>


    </main>
    <script src="assets/js/home/home.js"></script>
    <script src="test/js/loja.js"></script>

    <script>
      const caixa = document.querySelector('.cart-display');
      const cartButton = document.getElementById('cart-button');
      const closeCartButton = document.querySelector('.close-cart');

      cartButton.addEventListener('click', () => {
        caixa.style.display = 'flex';
      });
      closeCartButton.addEventListener('click', () => {
        caixa.style.display = 'none';
      });
    </script>
</body>

</html>
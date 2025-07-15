<?php

session_start();
include_once('assets/config/config.php');
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
  <title>Bem-vindo <?php if (isset($_SESSION['user'])) echo '|' . htmlspecialchars($_SESSION['user']); ?></title>
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
        <img src="logo.png" alt="CodingNepal" class="header-logo" />
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
            <a href="products.php" class="menu-link">
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
    <main>
      <h1>Vendas do Mês</h1>
      <style>
        .table-wrapper {
          width: 100%;
          max-width: 100%;
          margin-top: 24px;
          background: #fff;
          border-radius: 12px;
          box-shadow: 0 2px 12px rgba(0,0,0,0.08);
          overflow: hidden;
          position: relative;
        }
        table.vendas-mes {
          width: 100%;
          border-collapse: separate;
          border-spacing: 0;
          font-size: 1rem;
          background: #fff;
        }
        table.vendas-mes th, table.vendas-mes td {
          padding: 12px 10px;
          text-align: center;
          min-width: 120px;
        }
        table.vendas-mes thead th {
          background: #f5f5f5;
          font-weight: 700;
          font-size: 1.08rem;
          border-bottom: 2px solid #ececec;
          position: sticky;
          top: 0;
          z-index: 2;
        }
        .tbody-scroll {
          display: block;
          max-height: 340px;
          overflow-y: auto;
          width: 100%;
        }
        .tbody-scroll tbody {
          display: table;
          width: 100%;
          table-layout: fixed;
        }
        .tbody-scroll tbody tr:nth-child(even) {
          background: #fafafa;
        }
        .tbody-scroll tbody tr:nth-child(odd) {
          background: #fff;
        }
        tfoot.sticky-total tr td {
          background: #f5f5f5;
          font-weight: 700;
          border-top: 2px solid #ececec;
          font-size: 1.08rem;
          position: sticky;
          bottom: 0;
          z-index: 2;
        }
        .tbody-scroll::-webkit-scrollbar {
          width: 10px;
          border-radius: 12px;
          background: #ececec;
        }
        .tbody-scroll::-webkit-scrollbar-thumb {
          background: #d1d1d1;
          border-radius: 12px;
        }
        .tbody-scroll {
          scrollbar-width: thin;
          scrollbar-color: #d1d1d1 #ececec;
        }
      </style>
      <div class="table-wrapper">
        <table class="vendas-mes">
          <thead>
            <tr>
              <th>Pedido</th>
              <th>Produto</th>
              <th>Quantidade Vendida</th>
              <th>Preço</th>
              <th>Gastos</th>
              <th>Lucro</th>
            </tr>
          </thead>
        </table>
        <div class="tbody-scroll">
          <table class="vendas-mes">
            <tbody>
            <tr>
              <td><a href="#">1</a></td>
              <td>Lanche</td>
              <td>25</td>
              <td>R$ 25,00</td>
              <td>R$ 18,75</td>
              <td>R$ 6,25</td>
            </tr>
          </tbody>
          <tfoot>
            </tbody>
          </table>
        </div>
        <table class="vendas-mes">
          <tfoot class="sticky-total">
            <tr>
              <td></td>
              <td>Total</td>
              <td>75</td>
              <td>R$ 121,00</td>
              <td>R$ 90,75</td>
              <td>R$ 30,25</td>
            </tr>
          </tfoot>
        </table>
          </tfoot>
        </table>
      </table>

    </main>
  </div>
  <script src="assets/js/home/home.js"></script>
</body>

</html>
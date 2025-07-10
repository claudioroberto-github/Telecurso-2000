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
         <?php echo "<p class="."user-name".">Welcome<b>$logged</b></p>"; ?>
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
      <main>
        <h1>Vendas do Mês</h1>
        <table>
          <tr>produtos</tr>
          <tr>gastos</tr>
          <tr>vendas</tr>
          <tr>lucro</tr>
        </table>
      </main>
    </div>
    <script src="assets/js/home/home.js"></script>
  </body>
</html>
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
              <span class="material-symbols-rounded" aria-label="Home">home</span>
              <span class="menu-label">Home</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="material-symbols-rounded" aria-label="Menu">menu</span>
              <span class="menu-label">Menu</span>
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
            <a href="products.php" class="menu-link">
              <span class="material-symbols-rounded" aria-label="Products">storefront</span>
              <span class="menu-label">Products</span>
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
          <button type="button" class="purchase-button" style="margin-top: 24px;">Finalizar Compra</button>
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
    <script src="assets/js/home/home.js"></script>

    <script>
      // Fecha o carrinho ao clicar no botão de fechar
      document.addEventListener('DOMContentLoaded', function() {
        var closeBtn = document.querySelector('.close-cart');
        var cartDisplay = document.querySelector('.cart-display');
        if (closeBtn && cartDisplay) {
          closeBtn.addEventListener('click', function() {
            cartDisplay.style.display = 'none';
          });
        }
      });

      
document.addEventListener('DOMContentLoaded', function () {
  const caixa = document.querySelector('.cart-display');
  const cartButton = document.getElementById('cart-button');
  const closeCartButton = document.querySelector('.close-cart');

  if (cartButton && caixa) {
    cartButton.addEventListener('click', () => {
      caixa.style.display = 'flex';
    });
  }

  if (closeCartButton && caixa) {
    closeCartButton.addEventListener('click', () => {
      caixa.style.display = 'none';
    });
  }

  ready(); // Inicializa funções
});

let totalAmount = "0,00";

function ready() {
  const cartTableBody = document.getElementById("cart-table-body");

  if (cartTableBody) {
    cartTableBody.addEventListener("click", function (event) {
      if (event.target.classList.contains("remove-product-button")) {
        removeProduct(event);
      }
    });

    cartTableBody.addEventListener("change", function (event) {
      if (event.target.classList.contains("product-qtd-input")) {
        checkIfInputIsNull(event);
      }
    });
  }

  const addToCartButtons = document.getElementsByClassName("button-hover-background");
  for (let i = 0; i < addToCartButtons.length; i++) {
    addToCartButtons[i].addEventListener("click", addProductToCart);
  }

  const purchaseButton = document.querySelector(".purchase-button");
  if (purchaseButton) {
    purchaseButton.addEventListener("click", makePurchase);
  }
}

function removeProduct(event) {
  const tr = event.target.closest("tr.cart-product");
  if (tr) {
    tr.remove();
    updateTotal();
  }
}

function checkIfInputIsNull(event) {
  if (event.target.value === "0") {
    event.target.closest("tr.cart-product").remove();
  }
  updateTotal();
}

function addProductToCart(event) {
  const button = event.target.closest("button");
  const productInfos = button.closest('.movie-product');
  const productImage = productInfos.querySelector(".product-image").src;
  const productName = productInfos.querySelector(".product-title").innerText;
  const productPrice = productInfos.querySelector(".product-price").innerText;

  const productsCartNames = document.getElementsByClassName("cart-product-title");
  for (let i = 0; i < productsCartNames.length; i++) {
    if (productsCartNames[i].innerText === productName) {
      const qtdInput = productsCartNames[i].closest("tr").querySelector(".product-qtd-input");
      qtdInput.value = parseInt(qtdInput.value) + 1;
      updateTotal();
      return;
    }
  }

  const newCartProduct = document.createElement("tr");
  newCartProduct.classList.add("cart-product");

  newCartProduct.innerHTML = `
    <td class="product-identification">
      <img src="${productImage}" alt="${productName}" class="cart-product-image" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; margin-right: 8px;">
      <strong class="cart-product-title">${productName}</strong>
    </td>
    <td style="text-align: center;">
      <span class="cart-product-price">${productPrice}</span>
    </td>
    <td style="text-align: center;">
      <input type="number" value="1" min="0" class="product-qtd-input" style="width: 50px; padding: 4px 8px; border-radius: 6px; border: 1px solid #ccc;">
      <button type="button" class="remove-product-button" style="padding: 4px 12px; border-radius: 6px; background: #f44336; color: #fff; border: none; cursor: pointer; font-size: 0.95rem; margin-left: 6px;">Remover</button>
    </td>
  `;

  document.getElementById("cart-table-body").appendChild(newCartProduct);
  updateTotal();
}

function makePurchase() {
  if (totalAmount === "0,00") {
    alert("Seu carrinho está vazio!");
  } else {
    alert(`
      Obrigado pela sua compra!
      Valor do pedido: R$${totalAmount}

      Volte sempre :)
    `);
    document.getElementById("cart-table-body").innerHTML = "";
    updateTotal();
  }
}

function updateTotal() {
  const cartProducts = document.getElementsByClassName("cart-product");
  let total = 0;

  for (let i = 0; i < cartProducts.length; i++) {
    const priceText = cartProducts[i].querySelector(".cart-product-price").innerText.replace("R$", "").replace(",", ".");
    const quantity = cartProducts[i].querySelector(".product-qtd-input").value;
    total += parseFloat(priceText) * parseInt(quantity);
  }

  totalAmount = total.toFixed(2).replace(".", ",");
  document.querySelector(".cart-total-container span").innerText = "R$" + totalAmount;
}

// Adicione ao final do seu script atual

function makePurchase() {
  if (totalAmount === "0,00") {
    alert("Seu carrinho está vazio!");
    return;
  }

  if (!confirm("Deseja realmente finalizar a compra?")) return;

  const cartProducts = document.getElementsByClassName("cart-product");
  const vendaProdutos = [];

  for (let i = 0; i < cartProducts.length; i++) {
    const title = cartProducts[i].querySelector(".cart-product-title").innerText;
    const priceText = cartProducts[i].querySelector(".cart-product-price").innerText.replace("R$", "").replace(",", ".");
    const quantity = parseInt(cartProducts[i].querySelector(".product-qtd-input").value);
    const preco = parseFloat(priceText);
    const gasto = preco * 0.75;
    const lucro = preco * 0.25;

    vendaProdutos.push({
      produto: title,
      quantVendida: quantity,
      preco: preco,
      gasto: gasto,
      lucro: lucro
    });
  }

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "assets/config/salvar_venda.php", true);
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      alert("Compra finalizada com sucesso!");
      document.getElementById("cart-table-body").innerHTML = "";
      updateTotal();
    }
  };
  xhr.send(JSON.stringify({ venda: vendaProdutos }));
}



    </script>
</body>

</html>
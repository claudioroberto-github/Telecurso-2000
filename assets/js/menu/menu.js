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

  ready();
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
  if (parseInt(event.target.value) <= 0) {
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
function updateTotal() {
  const cartProducts = document.getElementsByClassName("cart-product");
  let total = 0;

  for (let i = 0; i < cartProducts.length; i++) {
    const priceText = cartProducts[i].querySelector(".cart-product-price").innerText.replace("R$", "").replace(",", ".");
    const quantity = cartProducts[i].querySelector(".product-qtd-input").value;
    total += parseFloat(priceText) * parseInt(quantity);
  }

  totalAmount = total.toFixed(2).replace(".", ",");
  const totalSpan = document.querySelector(".cart-total-container span");
  if (totalSpan) totalSpan.innerText = "R$" + totalAmount;
}

function makePurchase() {
  const cartProducts = document.querySelectorAll("tr.cart-product");
  const carrinho = [];

  if (cartProducts.length === 0) {
    alert("Seu carrinho está vazio!");
    return;
  }

  if (!confirm("Deseja realmente finalizar a compra?")) return;

  cartProducts.forEach(product => {
    const nome = product.querySelector(".cart-product-title").innerText;
    const precoText = product.querySelector(".cart-product-price").innerText.replace("R$", "").replace(",", ".");
    const quantidade = parseInt(product.querySelector(".product-qtd-input").value);
    const preco = parseFloat(precoText);
    const gasto = preco * 0.75;
    const lucro = preco * 0.25;

    carrinho.push({
      nome,
      preco,
      quantidade,
      gasto,
      lucro
    });
  });

  fetch("assets/config/salvar_venda.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/json"
  },
  body: JSON.stringify({ carrinho }) // ✅ CORRETO
})

  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert("Compra finalizada com sucesso!");
      document.getElementById("cart-table-body").innerHTML = "";
      updateTotal();
    } else {
      alert("Erro: " + (data.message || "Erro desconhecido"));
    }
  })
  .catch(error => {
    console.error("Erro:", error);
    alert("Erro ao enviar para o servidor.");
  });
}

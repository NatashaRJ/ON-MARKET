// Exibir ou ocultar o carrinho
function toggleCart() {
    const cart = document.getElementById("cart");
    if (cart.style.display === "block") {
      cart.style.display = "none";
    } else {
      cart.style.display = "block";
    }
  }
  
  // Fechar o carrinho
  function closeCart() {
    document.getElementById("cart").style.display = "none";
  }
  
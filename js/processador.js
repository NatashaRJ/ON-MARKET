let cart = [];

function loadCart() {
  const cartData = localStorage.getItem('cart');
  if (cartData) {
    cart = JSON.parse(cartData);
    renderCart();
  }
}

function saveCart() {
  localStorage.setItem('cart', JSON.stringify(cart));
}

function addToCart(productName, productPrice) {
  cart.push({ name: productName, price: productPrice });
  saveCart();
  renderCart();
}

function renderCart() {
  const cartItems = document.getElementById('cart-items');
  cartItems.innerHTML = 'Processador AMD Ryzen 7 5700X 3.4GHz - R$2.500,00';
  cart.forEach((item, index) => {
    const li = document.createElement('li');
    li.textContent = `${item.name} - R$${item.price.toFixed(2)}`;
    const removeButton = document.createElement('button');
    removeButton.textContent = 'Remover';
    removeButton.onclick = () => {
      removeFromCart(index);
    };
    li.appendChild(removeButton);
    cartItems.appendChild(li);
  });
}

function removeFromCart(index) {
  cart.splice(index, 1);
  saveCart();
  renderCart();
}

function clearCart() {
  cart = [];
  saveCart();
  renderCart();
}

function toggleCart() {
  const cartElement = document.getElementById('cart');
  cartElement.style.display = cartElement.style.display === 'none' ? 'block' : 'none';
}

document.addEventListener('DOMContentLoaded', () => {
  loadCart();
});

// Inicializar o carrinho a partir do localStorage
let cart = JSON.parse(localStorage.getItem('cart')) || []; // Se não houver carrinho no localStorage, cria um vazio

// Carregar o carrinho do localStorage ao iniciar
function loadCart() {
  if (cart.length > 0) {
    renderCart(); // Apenas renderiza se houver itens no carrinho
  }
}

// Salvar o carrinho no localStorage
function saveCart() {
  localStorage.setItem('cart', JSON.stringify(cart)); // Salvar o carrinho como string JSON
}

// Adicionar um item ao carrinho
function addToCart(productName, productPrice) {
  cart.push({ name: productName, price: productPrice });
  saveCart();  // Salvar o carrinho no localStorage
  renderCart(); // Atualizar a visualização do carrinho
  toggleCart(); // Mostrar o carrinho após adicionar item
}

// Renderizar os itens no carrinho
function renderCart() {
  const cartItems = document.getElementById('cart-items');
  cartItems.innerHTML = ''; // Limpar itens atuais do carrinho

  if (cart.length === 0) {
    cartItems.innerHTML = '<li>Seu carrinho está vazio.</li>';
  } else {
    cart.forEach((item, index) => {
      const li = document.createElement('li');
      li.textContent = `${item.name} - R$${item.price.toFixed(2)}`;
      
      const removeButton = document.createElement('button');
      removeButton.textContent = 'Remover';
      removeButton.onclick = () => {
        removeFromCart(index); // Função para remover o item
      };
      
      li.appendChild(removeButton);
      cartItems.appendChild(li);
    });
  }
}

// Remover um item do carrinho
function removeFromCart(index) {
  cart.splice(index, 1); // Remover o item do array
  saveCart(); // Salvar o carrinho atualizado no localStorage
  renderCart(); // Atualizar a visualização do carrinho
}

// Limpar todo o carrinho
function clearCart() {
  cart = []; // Limpar todos os itens do carrinho
  saveCart(); // Salvar carrinho vazio no localStorage
  renderCart(); // Atualizar a interface do carrinho
}

// Alternar visibilidade do carrinho
function toggleCart() {
  const cartElement = document.getElementById('cart');
  cartElement.style.display = cartElement.style.display === 'none' ? 'block' : 'none'; // Alternar visibilidade
}

// Adicionar um evento de clique para abrir/fechar o carrinho
document.getElementById('cart-icon').addEventListener('click', toggleCart);

// Carregar o carrinho quando a página for carregada
loadCart();


// Habilitar modo escuro
function toggleDarkMode() {
  document.body.classList.toggle('dark-mode');
  if (document.body.classList.contains('dark-mode')) {
    localStorage.setItem('darkMode', 'enabled');
  } else {
    localStorage.setItem('darkMode', 'disabled');
  }
}

// Verificar preferências de modo escuro
function checkDarkModePreference() {
  if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark-mode');
  }
}

// Esperar o DOM carregar e então inicializar o carrinho e o modo escuro
document.addEventListener('DOMContentLoaded', () => {
  loadCart();
  checkDarkModePreference();
});

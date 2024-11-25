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
  
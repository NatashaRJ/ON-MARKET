// Função para alternar o modo escuro
function toggleDarkMode() {
  document.body.classList.toggle('dark-mode');
  if (document.body.classList.contains('dark-mode')) {
    localStorage.setItem('darkMode', 'enabled');
  } else {
    localStorage.setItem('darkMode', 'disabled');
  }
}

// Verifica a preferência do modo escuro ao carregar a página
function checkDarkModePreference() {
  if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark-mode');
  }
}

// Chama a função ao carregar a página
document.addEventListener('DOMContentLoaded', checkDarkModePreference);


function aumentarLetra() {
    let body = document.body;
    let currentSize = window.getComputedStyle(body).fontSize;
    let newSize = parseFloat(currentSize) * 1.2; // Aumenta 20%
    body.style.fontSize = newSize + 'px';
}

function diminuirLetra() {
    let body = document.body;
    let currentSize = window.getComputedStyle(body).fontSize;
    let newSize = parseFloat(currentSize) * 0.8; // Diminui 20%
    body.style.fontSize = newSize + 'px';
}




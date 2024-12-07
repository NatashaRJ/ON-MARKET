<?php
session_start();

// Inicializar o carrinho se não existir
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Adicionar produto ao carrinho
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // Adicionar produto ao carrinho
    $_SESSION['cart'][] = [
        'name' => $product_name,
        'price' => $product_price
    ];

    echo json_encode(['status' => 'success', 'message' => 'Produto adicionado ao carrinho!']);
    exit;
}

// Limpar carrinho
if (isset($_POST['action']) && $_POST['action'] == 'clear') {
    unset($_SESSION['cart']);
    echo json_encode(['status' => 'success', 'message' => 'Carrinho limpo!']);
    exit;
}

// Processar pagamento (apenas um exemplo)
if (isset($_POST['action']) && $_POST['action'] == 'pay') {
    if (empty($_SESSION['cart'])) {
        echo json_encode(['status' => 'error', 'message' => 'O carrinho está vazio!']);
    } else {
        // Aqui você pode adicionar a lógica de pagamento
        echo json_encode(['status' => 'success', 'message' => 'Pagamento realizado com sucesso!']);
        unset($_SESSION['cart']); // Limpar carrinho após o pagamento
    }
    exit;
}
?>







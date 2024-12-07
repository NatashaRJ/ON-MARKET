<?php
// Ativar exibição de erros (remova em produção)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Captura e sanitiza os dados do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_NUMBER_INT);
    $cartao = filter_input(INPUT_POST, 'cartao', FILTER_SANITIZE_NUMBER_INT);
    $validade = filter_input(INPUT_POST, 'validade', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cvv = filter_input(INPUT_POST, 'cvv', FILTER_SANITIZE_NUMBER_INT);

    // Valida campos obrigatórios
    if (empty($nome) || empty($email) || empty($endereco) || empty($cidade) || empty($estado) || 
        empty($cep) || empty($cartao) || empty($validade) || empty($cvv)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit;
    }

    // Validação do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Endereço de email inválido.";
        exit;
    }

    // Validação do número do cartão (simplificada, não real)
    if (strlen($cartao) !== 16 || !ctype_digit($cartao)) {
        echo "Número do cartão inválido.";
        exit;
    }

    // Validação do CVV
    if (strlen($cvv) !== 3 || !ctype_digit($cvv)) {
        echo "CVV inválido.";
        exit;
    }

    // Simula processamento (substitua isso pela integração com API de pagamento)
    $processamentoBemSucedido = true; // Exemplo de sucesso

    if ($processamentoBemSucedido) {
        echo "Pagamento processado com sucesso! Obrigado por sua compra.";
    } else {
        echo "Ocorreu um erro ao processar o pagamento. Tente novamente.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>

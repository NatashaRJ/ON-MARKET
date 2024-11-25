<?php
require 'fpdf186/fpdf.php';

// Verifica se os dados foram passados via POST
if (isset($_POST['cadastro'])) {
    // Deserializa os dados recebidos do formulário
    $cadastro = unserialize($_POST['cadastro']);

    // Criação do PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    // Definindo o título do PDF
    $texto = 'GERENCIAR USUÁRIOS';
    // Adicionando o título com suporte a UTF-8
    $texto = mb_convert_encoding($texto, 'ISO-8859-1', 'UTF-8');
    $pdf->Cell(0, 10, $texto, 0, 1, 'C');

    // Adicionando espaço entre o título e os dados
    $pdf->Ln(10);

    // Iterando sobre cada usuário no array de cadastro
    foreach ($cadastro as $usuario) {
        // Cabeçalho e preenchimento dos dados (com os números ao lado dos campos)
        $pdf->SetFont('Arial', '', 12);

        // ID com o nome
        $pdf->Cell(40, 10, mb_convert_encoding('ID: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['id_cad'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // Nome
        $pdf->Cell(40, 10, mb_convert_encoding('Nome: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['nome'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());


        // Formatação da Data de Nascimento
        // Supondo que $usuario['data_nascimento'] esteja no formato 'YYYY-MM-DD' (exemplo: '1990-05-15')
        $dataNascimento = DateTime::createFromFormat('Y-m-d', $usuario['data_nascimento']);
        if ($dataNascimento) {
        // Formata a data para o padrão brasileiro
        $dataNascimentoFormatada = $dataNascimento->format('d/m/Y');
        } else {
        // Caso a data não seja válida, exibe um texto padrão
        $dataNascimentoFormatada = 'Data inválida';
        }

        // Adiciona ao PDF
        $pdf->Cell(40, 10, mb_convert_encoding('Data de Nascimento: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($dataNascimentoFormatada, 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());


        // Sexo
        $pdf->Cell(40, 10, mb_convert_encoding('Sexo: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['sexo'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // Nome Materno
        $pdf->Cell(40, 10, mb_convert_encoding('Nome Materno: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['nome_materno'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // CPF
        $pdf->Cell(40, 10, mb_convert_encoding('CPF: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['cpf'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // E-mail
        $pdf->Cell(40, 10, mb_convert_encoding('E-mail: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['email'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // Telefone Celular
        $pdf->Cell(40, 10, mb_convert_encoding('Telefone Celular: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['telefone_celular'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // Telefone Fixo
        $pdf->Cell(40, 10, mb_convert_encoding('Telefone Fixo: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['telefone_fixo'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // Endereço
        $pdf->Cell(40, 10, mb_convert_encoding('Endereço: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['endereco'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // CEP
        $pdf->Cell(40, 10, mb_convert_encoding('CEP: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['cep'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // Cidade
        $pdf->Cell(40, 10, mb_convert_encoding('Cidade: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['cidade'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // Login
        $pdf->Cell(40, 10, mb_convert_encoding('Login: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['login'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // Nível de Acesso
        $pdf->Cell(40, 10, mb_convert_encoding('Nível de Acesso: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($usuario['nivel_acesso'], 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

        // Data e Hora de Cadastro
        // Supondo que $usuario['data_cadastro'] esteja no formato 'YYYY-MM-DD HH:MM:SS' (por exemplo: '2024-11-21 14:30:00')
        $dataHora = DateTime::createFromFormat('Y-m-d H:i:s', $usuario['data_cadastro']);
        if ($dataHora) {
        // Formata a data e hora para o formato brasileiro
        $dataHoraFormatada = $dataHora->format('d/m/Y H:i:s');
        } else {
        // Caso a data não seja válida, exibe um texto padrão
        $dataHoraFormatada = 'Data inválida';
        }

        $pdf->Cell(40, 10, mb_convert_encoding('Data/Hora Cadastro: ', 'ISO-8859-1', 'UTF-8'), 0, 0);
        $pdf->Cell(40, 10, mb_convert_encoding($dataHoraFormatada, 'ISO-8859-1', 'UTF-8'), 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());


        // Adiciona espaçamento antes do próximo usuário
        $pdf->Ln(5);
    }

    // Envia o PDF para o navegador
    $pdf->Output();
} else {
    // Caso os dados não sejam recebidos
    echo 'Erro: Dados de cadastro não encontrados.';
}
?>

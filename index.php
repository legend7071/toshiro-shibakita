<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Aluno</title>
</head>
<body>

<?php
ini_set("display_errors", 1);

echo 'Versão Atual do PHP: ' . phpversion() . '<br>';

$servername = "54.234.153.24";
$username = "root";
$password = "Senha123";
$database = "meubanco";

// Criar conexão
$link = new mysqli($servername, $username, $password, $database);

// Verificar a conexão
if ($link->connect_error) {
    die("Erro na conexão com o banco de dados: " . $link->connect_error);
}

// Gerar dados para o novo aluno
$nome = "Aluno" . rand(1, 100);
$sobrenome = "Sobrenome" . rand(1, 100);
$endereco = "Rua Exemplo, " . rand(1, 200);
$cidade = "Cidade Exemplo";
$host_name = gethostname();
$pergunta_seguranca = "Qual a sua cor favorita?";
$resposta_seguranca = "Azul"; // Você pode gerar isso dinamicamente ou obter de um formulário

// Preparar a query SQL para inserção (usando prepared statements para segurança)
$query = "INSERT INTO dados (Nome, Sobrenome, Endereco, Cidade, Host, `Pergunta de Segurança?`, Resposta) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $link->prepare($query);

// Vincular os parâmetros
$stmt->bind_param("sssssss", $nome, $sobrenome, $endereco, $cidade, $host_name, $pergunta_seguranca, $resposta_seguranca);

// Executar a query
if ($stmt->execute()) {
    echo "Novo registro criado com sucesso. Aluno ID gerado: " . $link->insert_id;
} else {
    echo "Erro ao criar o registro: " . $stmt->error;
}

// Fechar a declaração e a conexão
$stmt->close();
$link->close();

?>

</body>
</html>

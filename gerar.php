<?php
// Verifica se as informações necessárias foram enviadas
if (isset($_POST['quantidade']) && isset($_POST['nome']) && isset($_POST['telefone'])) {
    require_once 'conc.php';

    // Pega a quantidade de bilhetes selecionada
    $quantidade = $_POST['quantidade'];

    // Insere as informações do cliente no banco de dados
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $sql = "INSERT INTO clientes (nome, telefone) VALUES ('$nome', '$telefone')";
    if ($conn->query($sql) === false) {
        die("Erro ao inserir informações do cliente: " . $conn->error);
    }
    $cliente_id = $conn->insert_id;

    // Cria uma string para armazenar os números de bilhetes gerados
    $numeros_gerados = "";

    // Gera um número aleatório para cada bilhete
    for ($i = 1; $i <= $quantidade; $i++) {
        // Gera um número no padrão da loteria federal
        $numero = mt_rand(10000, 99999);

        // Verifica se o número já foi vendido
        $sql = "SELECT * FROM clientes WHERE FIND_IN_SET($numero, bilhete)";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $i--;
            continue;
        }

        // Adiciona o número de bilhete gerado à string
        $numeros_gerados .= $numero . ",";

    }

    // Remove a última vírgula da string
    $numeros_gerados = rtrim($numeros_gerados, ",");

    // Insere as informações dos bilhetes no banco de dados
    $sql = "UPDATE clientes SET bilhete='$numeros_gerados' WHERE id=$cliente_id";
    if ($conn->query($sql) === false) {
        die("Erro ao inserir informações dos bilhetes: " . $conn->error);
    }

    // Redireciona o usuário para a página de resultado com os números de bilhetes gerados
    header("Location: resultado.php?numeros=" . $numeros_gerados);
    exit();
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="stayle.css">
<head>
    <title>Gerar Rifa</title>
</head>
<body>
    <h1>Rifa</h1>
    <form method="post" action="gerar.php">
        <label for="quantidade">Quantidade de bilhetes:</label>
        <input type="number" id="quantidade" name="quantidade" min="1" max="1000" required><br><br>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br><br>
        <button type="submit">Gerar Rifa</button>
    </form>
</body>
</html>

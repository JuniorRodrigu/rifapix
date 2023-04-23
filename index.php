<?php
require_once 'conc.php';


// Consulta SQL para buscar o valor do bilhete
$sql = "SELECT valor FROM valor LIMIT 1";

// Executa a consulta
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$precoUnitario = $row["valor"];
} else {
	 // valor padrão em caso de falha na consulta
}

// Fecha a conexão com o banco de dados
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<title>Escolha a quantidade de bilhetes</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="stayle.css">
</head>


<body>
	

	<?php include 'nav.php' ?>

	<div>
		<form action="informacoes.php" method="post">

			<h1>Escolha a quantidade de bilhetes</h1>

			<div class="img">
				<img class="imagem" src="testefot.jpg" alt="">
			</div>

			<div class="container">
				<div class="adiction">
					<button type="button" id="decrement" onclick="stepper(-1)">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 255, 1);">
							<path d="M5 11h14v2H5z"></path>
						</svg>
					</button>
					<input type="number" min="1" max="20000" step="1" value="1" name="quantidade" id="quantidade" oninput="stepper(0)">
					<button type="button" id="increment" onclick="stepper(1)">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 255, 1);">
							<path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path>
						</svg>
					</button>
					
				</div>
			</div>
			<div class="add">
			<button type="button" id="add-10">+10</button>
			<button type="button" id="add-25">+25</button>
			<button type="button" id="add-50">+50</button>
			<button type="button" id="add-100">+100</button>
			</div>
			<p id="total"><?php echo "Total: R$ " . number_format($precoUnitario, 2, ",", ".") ?></p>


			<button type="submit" id="continuar" name="submit">Continuar</button>

		</form>
	</div>
	

	<script>
  // Obter referência ao campo de entrada da quantidade e ao parágrafo para exibir o total
  const quantidadeInput = document.getElementById("quantidade");
  const totalParagrafo = document.getElementById("total");

  // Definir o preço unitário dos bilhetes
  const precoUnitario = <?php echo $precoUnitario ?>;

  // Adicionar um ouvinte de eventos para o campo de entrada da quantidade
  quantidadeInput.addEventListener("input", () => {
    // Obter a quantidade atual
    const quantidade = quantidadeInput.value;

    // Verificar se a quantidade está dentro do intervalo permitido
    if (quantidade >= 1 && quantidade <= 10000) {
      // Calcular o valor total e atualizar o parágrafo
      const total = quantidade * precoUnitario;
      totalParagrafo.innerText = `Total: R$ ${total.toFixed(2)}`;
    }
  });

  function stepper(value) {
    const quantidade = parseInt(quantidadeInput.value);
    const novoValor = quantidade + value;

    // Verificar se o novo valor está dentro do intervalo permitido
    if (novoValor >= 1 && novoValor <= 10000) {
      quantidadeInput.value = novoValor;
      const total = novoValor * precoUnitario;
      totalParagrafo.innerText = `Total: R$ ${total.toFixed(2)}`;
    }
  }

  const add100Button = document.getElementById("add-100");
  add100Button.addEventListener("click", () => {
    const quantidade = parseInt(quantidadeInput.value);
    const novoValor = quantidade + 100;

    // Verificar se o novo valor está dentro do intervalo permitido
    if (novoValor <= 10000) {
      quantidadeInput.value = novoValor;
      const total = novoValor * precoUnitario;
      totalParagrafo.innerText = `Total: R$ ${total.toFixed(2)}`;
    }
  });
  // Obter referência aos novos botões de adição
const add10Button = document.getElementById("add-10");
const add25Button = document.getElementById("add-25");
const add50Button = document.getElementById("add-50");

// Adicionar ouvinte de eventos para o botão "+10"
add10Button.addEventListener("click", () => {
  stepper(10);
});

// Adicionar ouvinte de eventos para o botão "+25"
add25Button.addEventListener("click", () => {
  stepper(25);
});

// Adicionar ouvinte de eventos para o botão "+50"
add50Button.addEventListener("click", () => {
  stepper(50);
});

</script>


	


</body>

</html>
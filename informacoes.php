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
  $precoUnitario = 0;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comprar Rifa</title>
  <link rel="stylesheet" href="style-info.css">
</head>
<body>
  <?php
    $quantidade = $_POST['quantidade'];
    $total = $precoUnitario * $quantidade;
  ?>

  <div id="info">
  <form class="info" method="post" action="pagpix.php?total=<?php echo $total; ?>">
      <div class="container">
        <div class="input-container">
          <input type="hidden" id="quantidade" name="quantidade" value="<?php echo $quantidade; ?>">
          <input type="hidden" id="quantidade" name="quantidade" value="<?php echo $total; ?>">
          <input type="hidden" id="total" name="total" value="<?php echo $total; ?>">
          <label class="label" for="nome">Nome:</label>
          <input class="text-input" type="text" id="nome" name="nome" required><br><br>
          <label class="label" for="telefone">Telefone:</label>
          <input class="text-input" type="text" id="telefone" name="telefone" required><br><br>
          <button type="submit">Próximo</button>
        </div>
      </div>
    </form>
    <script>
    function modalPix(){
  var total = '<?php echo $total ?>'; // obter o valor do total

  $("#modalPix").modal('show');

  $.post('payment.php', {pix:true, total: total}, function(response){
    // ...
  });
}
</script>

    <script>
      document.querySelectorAll(".text-input").forEach((element) => {
        element.addEventListener("blur", (event) => {
          if (event.target.value != "") {
            event.target.nextElementSibling.classList.add("filled");
          } else {
            event.target.nextElementSibling.classList.remove("filled");
          }
        });
      });
    </script>
  </div>
</body>
</html>

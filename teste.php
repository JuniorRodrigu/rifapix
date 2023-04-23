<?php

require_once 'conc.php';

if(isset($_POST['telefone'])){
  $telefone = $_POST['telefone'];
  
  // Definição da consulta SQL
  $sql = "SELECT bilhete FROM clientes WHERE telefone = '$telefone'";

  // Executa a consulta
  $result = $conn->query($sql);

  echo "Bilhetes: " ;
  if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      
      echo " ".$row["bilhete"];
    }
  } else {
    echo "Nenhum bilhete encontrado para este número de telefone.";
  }
  
  // Fecha a conexão com o banco de dados
  $conn->close();
}

?>

<form method="post">
  <label for="telefone">Telefone:</label>
  <input type="text" id="telefone" name="telefone">
  <button type="submit">Buscar</button>
</form>


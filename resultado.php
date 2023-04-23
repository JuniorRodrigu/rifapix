<?php
if (isset($_GET['numeros'])) {
    $numeros = explode(",", $_GET['numeros']);
    echo "Número do bilhete gerado:";
    foreach ($numeros as $numero) {
        
        echo "  $numero";
    }
} else {
    echo "Nenhum bilhete gerado ainda";
}
?>

<br>
<a href="index.php">Voltar</a>
<?php
// Verificar se o pagamento foi confirmado com sucesso
if ($_POST['status'] == 'success') {
  // Redirecionar o usuário para a página de confirmação
  header('Location: confirmacao.html');
  exit;
} else {
  // Se houver algum erro no pagamento, exibir uma mensagem de erro
  echo 'Erro no pagamento.';
}
?>

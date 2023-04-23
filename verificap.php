<?php

$access_token = "APP_USR-3991797296774206-031222-f217118f51717132e996df82d7046ec0-200617663";

// Recebe o conteúdo da notificação
$notification = file_get_contents('php://input');

// Decodifica o conteúdo da notificação
$notification = json_decode($notification);

// Obtém o ID do pagamento
$payment_id = $notification->data->id;

// Obtém o status atual do pagamento
$status = $notification->data->status;

// Atualiza o status do pagamento na base de dados do seu sistema
// ...

// Verifica se o pagamento foi aprovado
if ($status == 'approved') {
    // Retorna uma resposta de sucesso ao Mercado Pago
    http_response_code(200);
} else {
    // Retorna uma resposta de erro ao Mercado Pago
    http_response_code(400);
}
?>
<?php

$access_token = "APP_USR-3991797296774206-031222-f217118f51717132e996df82d7046ec0-200617663";

// Recebe o conteúdo da notificação
$notification = file_get_contents('php://input');

// Decodifica o conteúdo da notificação
$notification = json_decode($notification);

// Obtém o ID do pagamento
$payment_id = $notification->data->id;

// Obtém o status atual do pagamento
$status = $notification->data->status;

// Atualiza o status do pagamento na base de dados do seu sistema
// ...

// Verifica se o pagamento foi aprovado
if ($status == 'approved') {
    // Retorna uma resposta de sucesso ao Mercado Pago
    http_response_code(200);
} else {
    // Retorna uma resposta de erro ao Mercado Pago
    http_response_code(400);
}
?>

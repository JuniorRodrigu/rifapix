<?php

$access_token = "APP_USR-3991797296774206-031222-f217118f51717132e996df82d7046ec0-200617663";

if (isset($_POST['type']) && $_POST['type'] == 'payment') {

  $payment_id = $_POST['data']['id'];

  $status = $_POST['data']['status'];

  if ($status == 'approved') {

    header('Location: https://www.youtube.com/' . $payment_id);
    exit();
  }
}
if (isset($_GET['payment_id'])) {

  $payment_id = $_GET['payment_id'];

  include_once 'mercadopago/lib/mercadopago/vendor/autoload.php';

  MercadoPago\SDK::setAccessToken($access_token);

  $payment = MercadoPago\Payment::find_by_id($payment_id);
  if ($payment->status == 'approved') {
    header('Location: https://seusite.com/pagina-de-agradecimento.php');
    exit();
  }
}

if (isset($_POST['pix'])) {

  if ($_POST['pix']) {

    $valor = $_POST['total'];

    include_once 'mercadopago/lib/mercadopago/vendor/autoload.php';

    MercadoPago\SDK::setAccessToken($access_token);

    $payment = new MercadoPago\Payment();
    $payment->description = 'Pagamento Nome';
    $payment->transaction_amount = (float)$valor;
    $payment->payment_method_id = "pix";

    $payment->notification_url   = 'https://seusite.com/notification.php';
    $payment->external_reference = '1520';

    $payment->payer = array(
      "email" => 'emailcliente@gmail.com',
      "first_name" => 'Primeiro nome do cliente',
      "address" =>  array(
        "zip_code" => "06233200",
        "street_name" => "Av. das Nações Unidas",
        "street_number" => "3003",
        "neighborhood" => "Bonfim",
        "city" => "Osasco",
        "federal_unit" => "SP"
      )
    );

    $payment->save();

    echo json_encode($payment->point_of_interaction);
  } else {
    echo json_encode(array(
      'status'  => 'error',
      'message' => 'pix required'
    ));
    exit;
  }
} else {
  echo json_encode(array(
    'status'  => 'error',
    'message' => 'pix not found'
  ));
  exit;
}

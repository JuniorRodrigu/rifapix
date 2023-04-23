<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Página de pagamento</title>
</head>
<body>
    <?php
        $nome_completo = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $valor = $_POST['valor'];
        $id_vendedor = 'SEU_ID_DE_VENDEDOR_AQUI';
        $quantidade = $_POST['quantidade'];
        $nome_produto = 'Nome do Produto';
        
        // Gerar link do Mercado Pago com os dados do pagamento
        $link_mp = "https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=". $id_vendedor ."&amount=". $valor ."&quantity=". $quantidade ."&external_reference=". $nome_completo ."&item_title=". $nome_produto;
        
        // Gerar QR Code do Pix do Mercado Pago
        $chave_pix = 'CHAVE_PIX_AQUI';
        $url_pix = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=';
        $qr_code_pix = $url_pix . urlencode('pix:'. $chave_pix .'?txid='. $nome_completo .'&v='. $valor);
    ?>

    <h2>Resumo do pagamento</h2>
    <p>Valor total a ser pago: R$ <?php echo $valor; ?></p>
    <p>Quantidade de bilhetes: <?php echo $quantidade; ?></p>
    <img src="<?php echo $qr_code_pix; ?>" alt="QR Code do Pix">
    <br><br>
    <a href="<?php echo $link_mp; ?>"><button>Pagar com Mercado Pago</button></a>
</body>
</html>

<?php
/**
 *
 *   AKÖde POS Alttantire Yazılım Çözümleri tarafından geliştirilmiştir.

 *
 * @author      Alttantire Yazılım Çözümleri <info@alttantire.com>
 * @site        <https//alttantire.com/>
 * @date        2022
 *
 */

include "../src/Gateway.php";

//### Sanal POS Üye İşyeri Ayarları
/*
 * apiUser: SMS ile iletilen ApiUser bilgisi
 * clientId: SMS ile iletilen clientId bilgisi
 * apiPass: SMS ile iletilen apiPass bilgisi
 *
 * Environment:
 *
 *  ** "LIVE" = "https://api.akodepos.com/api/Payment/"
 *  ** "TEST" = "https://ent.akodepos.com/api/Payment/"
 */

$apiUser = "POS_ENT_Test_001"; // Api kullanıcı adınız
$clientId = "1000000494"; // Api müşteri numaranız
$apiPass = "POS_ENT_Test_001!*!*"; // Api şifreniz
$environment = "https://ent.akodepos.com/api/Payment/";
$callback_url = $_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], "/")) . "/payment-response.php"; // Ödeme işlem sonucunun döneceği adres - https://www.siteadresiniz.com/3D-sonuc.php

//### Sipariş Bilgileri
$orderId = ""; // Sipariş numarası her sipariş için tekil olmalıdır. Boş bırakıldığında sistem tarafından üretilir
$amount = 1090; // 10 TL 90 kuruş
$instalment = 0; // Taksit sayısı - Tek çekim için 0

//### API Gateway
$gateway = new Gateway($environment, $clientId, $apiUser, $apiPass);
try {
    $payment = $gateway->startPaymentThreeDSession($callback_url, $amount, $instalment, $orderId);
} catch (Exception $e) {
    print_r($e);
}

$iframeUrl = $gateway->getFrameUrl($payment->ThreeDSessionId);

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>AKÖde POS Ortak Ödeme Sayfası - Örnek</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <style>

        body {
            margin-top: 20px;
        }

        .panel-title {
            display: inline;
            font-weight: bold;
        }

        .checkbox.pull-right {
            margin: 0;
        }

        .pl-ziro {
            padding-left: 0px;
        }

    </style>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12  ">
            <iframe src="<?php echo $iframeUrl ?>" style=" width:100%; height: 550px;position: relative;" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>

<?php include("test-credit-cards.php");?>


</body>
</html>



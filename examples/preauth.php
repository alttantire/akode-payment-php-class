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

//### API Gateway
$gateway = new Gateway($environment, $clientId, $apiUser, $apiPass);

//### Sipariş Bilgileri
$amount=24990; // 249 TL 90 Kuruş
$installment=0; // Tek çekim
$orderId=""; // Sipariş numarası - Boş gönderildiğinde sistem tarafından otomatik üretilir
$description=""; // Opsiyonel sipariş açıklaması
$callbackUrl = "//".$_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], "/"))."/payment-response.php"; // Ödeme işlem sonucunun döneceği adres - https://www.siteadresiniz.com/3D-sonuc.php

try {
    $preAuth = $gateway->threeDPreAuth($callbackUrl, $amount, $installment, $orderId, $description);
    $ThreeDSessionId = $preAuth->ThreeDSessionId;

    echo "<pre>".print_r($preAuth,true)."</pre>";

} catch (Exception $e) {
    print_r($e);
}
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

/*
 * Siparişi iptal eder ve tutarı müşteriye iade eder
 */

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

//### Sipariş Bilgileri
$orderId = "20221011999"; // Sipariş numarası

//### API Gateway
$gateway = new Gateway($environment, $clientId, $apiUser, $apiPass);
$paymentCheck = $gateway->void($orderId);

echo "<pre>";
print_r($paymentCheck);

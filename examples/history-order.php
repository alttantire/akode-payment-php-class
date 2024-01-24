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
 * İlgili tarihteki tüm işlem geçmişini listeler.
 * Sipariş numarası gönderilmesi durumunda o siparişin tüm işlem geçmişini listeler.
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

//### API Gateway
$gateway = new Gateway($environment, $clientId, $apiUser, $apiPass);

/*
 * Sipariş numarası dolu gönderildiğinde o siparişe ait tüm işlemleri listeler.
 * Sipariş numarası boş gönderildiğinde o tarihteki tüm siparişleri listeler
*/
$orderId = "20221011999";

/*
 * Sipariş tarihi integer olmalıdır.
 * Listesi istenen tarih YYYYAAGG formatında yazılmalıdır.
*/
$date = 20221011;

try {
    $paymentCheck = $gateway->history($date, $orderId, $page = 1, $pageSize = 10);
} catch (Exception $e) {
    print_r($e);
}

echo "<pre>";
print_r($paymentCheck);

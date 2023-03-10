<?php
/**
 *
 *   AKÖde POS adına Alttantire Yazılım Çözümleri tarafından geliştirilmiştir.
 *   Tüm hakları AKÖde POS'a aittir.
 *
 * @author      Alttantire Yazılım Çözümleri <info@alttantire.com>
 * @site        <https//akodepos.com/>
 * @date        2022
 *
 */

include "../src/Gateway.php";

//### Sanal POS Üye İşyeri Ayarları
$apiUser = "Entegrasyon_01"; // Api kullanıcı adınız
$clientId = "1000000032"; // Api müşteri numaranız
$apiPass = "gkk4l2*TY112"; // Api şifreniz
$environment = "TEST"; // "LIVE" - Gerçek ortam | "TEST" - Test ortam

//### Sipariş Bilgileri
$orderId = "20221011999"; // Sipariş numarası

//### API Gateway
$gateway = new Gateway($environment, $clientId, $apiUser, $apiPass);
$paymentCheck = $gateway->inquiry($orderId);

echo "<pre>";
print_r($paymentCheck);

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

/*
 * Siparişin belirtilen tutarını müşteriye iade eder
 */

//### Sanal POS Üye İşyeri Ayarları
$apiUser = "Entegrasyon_01"; // Api kullanıcı adınız
$clientId = "1000000032"; // Api müşteri numaranız
$apiPass = "gkk4l2*TY112"; // Api şifreniz
$environment = "TEST"; // "LIVE" - Gerçek ortam | "TEST" - Test ortam

//### Sipariş Bilgileri
$orderId = "202210109"; // Sipariş numarası
$amount=125; // İade edilecek tutar. 1 TL 25 Kuruş

//### API Gateway
$gateway = new Gateway($environment, $clientId, $apiUser, $apiPass);
$paymentCheck = $gateway->refund($orderId, $amount);

echo "<pre>";
print_r($paymentCheck);

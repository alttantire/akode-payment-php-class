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
?>

<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>AKÖde POS Komisyon ve Taksit Bilgileri - Örnek</title>
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
        <form role="form" method="post" action="#">

            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Kart Taksit ve Komisyon Bilgileri
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="cardNumber">
                                Bin No</label>
                            <div class="input-group">
                                <input type="text" class="form-control" maxlength="6" name="CardNo"
                                       placeholder="Kredi Kart Numarasının ilk 6 hanesi" required autofocus/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <button type="submit" class="btn btn-success btn-lg btn-block">Taksit ve Komisyon Bilgileri</button>
                <br/>

                <?php
                if ($_POST) {
                    $bin = filter_input(INPUT_POST, 'CardNo', FILTER_SANITIZE_SPECIAL_CHARS);
                    try {
                        $info = $gateway->getCommissionAndInstallmentInfo($bin);
                        echo "<pre>" . print_r($info, true) . "</pre>";
                    } catch (Exception $e) {
                        print_r($e->getMessage());
                    }
                }
                ?>
            </div>

        </form>
    </div>
</div>

<?php include("test-credit-cards.php"); ?>

</body>
</html>

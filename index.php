<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>API CONNEXION</title>
</head>
<body>
<?php include("connexionApi/connexion_api.php"); ?>
<div class="container">
    <form action="" method="POST">
        <?php
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://free.currconv.com/api/v7/currencies?apiKey=7fe003144c1aecbaad07",
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ));
        $response = curl_exec($curl);
        $response = json_decode($response, true);
        ?>
        <div class="form-group">
            <label>
                <select name="from">
                    <?php
                    foreach ($response['results'] as $oneResponse) {
                        ?>
                        <option class="optFrom"><?php echo $oneResponse['id'] . " - " . $oneResponse['currencyName']; ?></option>
                    <?php } ?>
                </select>
            </label>
        </div>

        <div class="form-group">
            <label>
                <select name="to">
                    <?php
                    foreach ($response['results'] as $oneResponse) {
                        ?>
                        <option><?php echo $oneResponse['id'] . " - " . $oneResponse['currencyName']; ?></option>
                    <?php } ?>
                </select>
            </label>
        </div>

        <div class="form-group">
                        <label>Amount
                            <input class="form-control" name="amount" type="text" id="amount">
                        </label>
        </div>

        <input type="submit" name="sub" class="btn btn-danger" value="Convertir">
    </form>
    <?php
    if (isset($_POST['from']) && isset($_POST['to']) && isset($_POST['amount'])) {
        $from = $_POST["from"];
        $to = $_POST["to"];
        $amount = $_POST["amount"];

        convertCurrency();
    }
    ?>
</div>

<!--<script>-->
<!--    $(document).ready(function () {-->
<!--        $('form').on('submit', function () {-->
<!--            $.ajax({-->
<!--                method: 'POST',-->
<!--                url: 'connexion_api.php',-->
<!--                data: $('form').serialize(),-->
<!--                success: function () {-->
<!--                }-->
<!--            });-->
<!--        });-->
<!--    })-->
<!--</script>-->

</body>
</html>
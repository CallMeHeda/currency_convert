<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <title>API CONNEXION</title>
</head>
<body>
<?php include("connexionApi/connexion_api.php"); ?>
<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://free.currconv.com/api/v7/currencies?apiKey=MyApiKey",
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false
));
$response = curl_exec($curl);
$response = json_decode($response, true);
?>
<div class="container">
    <div class="row" style="margin-bottom: 0;">
        <form method="POST" class="col s12" id="form">
            <div class="row" style="margin-bottom: 0;">
                <div class="input-field col s12 m6 l3">
                    <input id="amount" type="number" name="amount" class="validate" min="1" value="1" required>
                    <label for="icon_prefix">Amount</label>
                </div>

                <div class="input-field col s12 m6 l3">
                    <select name="from" class="browser-default">
                        <?php
                        foreach ($response['results'] as $oneResponse) {
                            ?>
                            <option id="optFrom" <?php if ($oneResponse['id'] == 'EUR') {
                                echo ' selected';
                            } ?>><?php echo $oneResponse['id'] . " - " . $oneResponse['currencyName']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <i class="material-icons prefix hiddendiv">swap_horiz</i>

                <div class="input-field col s12 m6 l3">
                    <select name="to" class="browser-default">
                        <?php
                        foreach ($response['results'] as $oneResponse) {
                            ?>
                            <option id="optTo" <?php if ($oneResponse['id'] == 'USD') {
                                echo ' selected';
                            } ?>><?php echo $oneResponse['id'] . " - " . $oneResponse['currencyName']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="input-field col s12 m6 l3">
                    <button class="btn blue darken-1 waves-effect waves-light" type="submit" name="action">Convert</button>
                </div>

            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['from']) && isset($_POST['to']) && isset($_POST['amount'])) {
        $from = $_POST["from"];
        $to = $_POST["to"];
        $amount = $_POST["amount"];
       ?>
        <div><?php convertCurrency(); ?></div>
    <?php } ?>
</div>
</body>
</html>
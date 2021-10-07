<?php
function convertCurrency()
{
    $from = explode(' ',trim($_POST["from"]));
    $to = explode(' ',trim($_POST["to"]));
    $amount = $_POST["amount"];

    $string = $from[0] . "_" . $to[0];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://free.currconv.com/api/v7/convert?q=" . $string . "&compact=ultra&apiKey=7fe003144c1aecbaad07",
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
    ));

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    $rate = floatval($response["$string"]);

    $total = $rate * $amount;
    echo "$amount $from[0] = $total $to[0]";
}

?>
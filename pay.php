  
 <?php
 session_start();
include("config_paytm.php");



$order_id = "ORDER".rand(10000,99999);
$amount = $_POST["amount"];

$_SESSION["amount"] = $amount;
$customer_id = "CUST" .rand(1000,9999);
$callback_url = PAYTM_CALLBACK_URL;

$paytmParams = array();
$paytmParams["MID"] = PAYTM_MERCHANT_MID;
$paytmParams["ORDER"] = $order_id;
$paytmParams["CUST_ID"] = $customer_id;
$paytmParams["TXN_AMOUNT"] = $amount;
$paytmParams["CHANNEL_ID"] = "WEB";
$paytmParams["WEBSITE"] ="WEMSTAGING";
$paytmParams["CALLBACK_URL"] = $callback_url; 
$paytmParams["INDUSTRY_TYPE_ID"] = "Retail";

$checksum= generateChecksum($paytmParams,$PAYTM_MERCHANT_KEY);

function generateChecksum($params,$key){
ksort($params);
$data = implode("|", $params);
return hash_hmac("sha256",$data,$key);
}
?>

<html>
 <body onload="document.paytm_form.submit()">
 <form method= "post" action="<?php echo PAYTM_TXN_URL; ?>" name="paytm_form">
 <?php
 foreach($paytmparams as $key => $value){
 echo '<input type= "hidden" name ="'.$key .' " value=" '.$value .' ">';
}
?>
<input type ="hidden" name="CHECKSUMHASH" value="<?php echo $check_sum;?>">
</form>
</body>
</html>
 
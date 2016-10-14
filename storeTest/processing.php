<?php

require '/home/peggylaw/square/vendor/autoload.php';

echo "<html><head></head><body><p>";

$nonce = $_POST['nonce_capture'];
require '/home/peggylaw/db-projects/sdvsq-connect-test.php';

#Create Customer to save info

$customer_api = new \SquareConnect\Api\CustomerApi();

$c_req_body = array (
	"given_name" => $_POST['firstName'],
    "family_name" => $_POST['lastName'],
    "email_address" => $_POST['email'],
    "address" => array (
    	"address_line_1" => $_POST['addressL1'],
        "address_line_2" => $_POST['addressL2'],
        "locality" => $_POST['city'],
        "administrative_district_level_1" => $_POST['state'],
        "postal_code" => $_POST['hidden_zip'],
        "country" => "US"
    ),
    "phone_number" => $_POST['phone']
);

try {
  $resulting_customer = $customer_api->createcustomer($access_token, $c_req_body); 
} catch (Exception $e) {
  echo "Caught exception " . $e->getMessage();
}

$customer = $resulting_customer->getCustomer();



#Beginning of Transaction

$transaction_api = new \SquareConnect\Api\TransactionApi();

$price_a = $_POST["price"] * 100;
$note_info = "Total Items: " . $_POST["quantity"];

$request_body = array (

	"card_nonce" => $nonce,
  	"amount_money" => array (
  		"amount" => $price_a,
  		"currency" => "USD"
 	 ),
	 "idempotency_key" => uniqid(),
     "note" => $note_info,
     "customer_id" => $customer["id"]
	 
);

# The SDK throws an exception if a Connect endpoint responds with anything besides 200 (success).
# This block catches any exceptions that occur from the request.
try {
  $resulting_transaction = $transaction_api->charge($access_token, $location_id, $request_body); 
} catch (Exception $e) {
  # echo "Caught exception " . $e->getMessage();
  echo "<div style='border: double'><center><br><h2>Oops! Something was wrong with your payment method. Please check your card information and try again.</h1><br>";
  echo "<button onclick='goBack()'>Go Back</button><script>function goBack() {window.history.back();}</script><br><br></div>";
  echo "<center>Error Specifics: " . $e->getMessage();
}

$transaction = $resulting_transaction->getTransaction();




#generate email - starting info
$c_address = $customer["address"];
$price_total = $_POST["price"];

#New Receipt Email

//define variables 
$vars = array (
    '{$product}' => "Total Items: " . $_POST["quantity"],//$_POST["product"],
    //'{$description}' => $_POST["option_1"]." - ".$_POST["option_2"],
    '{$price}' => $price_total.".00",
    //'{$quantity}'=> $_POST["quantity"],
    '{$date}' => $transaction["created_at"],
    '{$card}' => $_POST["card_type"]." ".$_POST["last_four"],
    '{$name}' => $customer["given_name"]." ".$customer["family_name"],
    '{$address_1}' => $c_address["address_line_1"]." ".$c_address["address_line_2"],
    '{$address_2}' => $c_address["locality"].", ".$c_address["administrative_district_level_1"]." ".$c_address["postal_code"],
    '{$email}' => $customer["email_address"],
    '{$phone}' => $customer["phone_number"],
    '{$section_3}' => 'All proceeds of your purchase go directly towards training service dogs for either diabetic alert, autism service, or physical assistance.'
    );

ob_start(); 
include('/home/peggylaw/servicedogsva.org/receipt-email/receipt.html'); 
$m = ob_get_contents(); 
ob_end_clean(); 
$message = strtr($m, $vars);

$headers  = 'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Me <office@servicedogsva.org>' . "\r\n";

mail("office@servicedogsva.org", "Service Dogs of VA Receipt", $message, $headers);
mail($customer["email_address"], "Service Dogs of VA Receipt", $message, $headers);
echo ${message};

echo "<center><br> A copy of this receipt has been emailed to you at ".$customer["email_address"].".<br>";
echo "<br><a href=https://servicedogsva.org>Return to Home Page</a>";

echo "</body></html>";
?>


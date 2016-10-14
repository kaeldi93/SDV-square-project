<?php
    require '/home/peggylaw/db-projects/sdvdb-connect.php';
	
	$gift_name = $_POST["gift_name"];
	$gift_address1 = $_POST["gift_address1"];
	$gift_address2 = $_POST["gift_address2"];
	$gift_memo = $_POST["gift_memo"];
	$gift_product = $_POST["gift_product"];
	$gift_options = $_POST["gift_options"];
	$gift_price = $_POST["gift_price"];
	
	//add gift to cart item
	$stmt = $conn->prepare("UPDATE cart SET gift_name=? WHERE product='$gift_product' AND price=$gift_price AND options='$gift_options'");
	$stmt->bind_param('s', $gift_name);
	$stmt->execute();
	
	//CLEAN
	$yesterday = strtotime("yesterday");
	$sql = "DELETE FROM gifts WHERE add_date < $yesterday";
    $gift_exists = $conn->query($sql);
	
	//ADD     
	$stmt = $conn->prepare("INSERT INTO gifts (gift_name, gift_address1, gift_address2, gift_memo) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE gift_address1=?, gift_address2=?, gift_memo=?");
	$stmt->bind_param('sssssss', $gift_name, $gift_address1, $gift_address2, $gift_memo, $gift_address1, $gift_address2, $gift_memo);
	$stmt->execute();
?>

<html>
    <form id=continues action=exp_checkout.php></form>
    <script>document.getElementById("continues").submit();</script>
</html>
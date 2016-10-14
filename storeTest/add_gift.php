<?php
    require '/home/peggylaw/db-projects/sdvdb-connect.php';
	
	$gift_name = $_POST["gift_name"];
	$gift_address1 = $_POST["gift_address1"];
	$gift_address2 = $_POST["gift_address2"];
	$gift_product = $_POST["gift_product"];
	$gift_options = $_POST["gift_options"];
	$gift_price = $_POST["gift_price"];
	
	$sql = "UPDATE cart SET gift_name='$gift_name' WHERE product='$gift_product' AND price=$gift_price AND options='$gift_options'";
	//$sql = "UPDATE cart SET gift_name='Hey You'
        if($conn->query($sql) == TRUE) {
            //updated cart item
        } else {
            //cart not updated
        }
	
	//CLEAN
	$yesterday = strtotime("yesterday");
	$sql = "DELETE FROM gifts WHERE add_date < $yesterday";
    $gift_exists = $conn->query($sql);
	
	//CREATE
    if($gift_exists != TRUE) {
        //gifts record did not exist
        $sql = "CREATE TABLE gifts (gift_name VARCHAR(100) NOT NULL, gift_address1 VARCHAR(225) NOT NULL, gift_address2 VARCHAR(225), add_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";
        if($conn->query($sql) == TRUE) {
            $conn->query("ALTER TABLE `gifts` ADD UNIQUE( `gift_name` )");
        } else {
            //failed to create new table
        }
    }
	
	//ADD
    //for($i = 0; $i < $quantity; $i++) {
        $sql = "INSERT INTO gifts (gift_name, gift_address1, gift_address2) VALUES ('$gift_name', '$gift_address1', '$gift_address2') ON DUPLICATE KEY UPDATE gift_address1='$gift_address1', gift_address2='$gift_address2'";
        //$sql = "INSERT INTO gifts (gift_name) VALUES ('$gift_name')";
		if($conn->query($sql) == TRUE) {
            //recipient added
        } else {
            //recipient not added
        }
    //}
	
	/*
    $cart_ip = $_SERVER['REMOTE_ADDR'];
    $gift_address1 = $POST["gift_address1"];
    if(isset($POST["gift_address2"])) {$gift_address2 = $POST["gift_address2"];} else {$gift_address2 = NULL;}
    
    //CLEAN
    $sql = "DELETE FROM cart WHERE add_date < $yesterday";
    $cart_exists = $conn->query($sql);
    
    
    
    if($cart_exists) {
        //APPLY
        $sql = "UPDATE cart SET gift_name='$gift_name' WHERE product='$gift_product' AND price=$gift_price AND options='$gift_options'";
        if($conn->query($sql) == TRUE) {
            //updated cart item
        } else {
            //cart not updated
        }
    }
*/
?>
<html>
    <form id=continues action=exp_checkout.php></form>
    <script>document.getElementById("continues").submit();</script>
</html>
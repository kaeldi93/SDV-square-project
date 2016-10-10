<?php
    $servername = "mysql.servicedogsva.org";
    $username = "ked9ua";
    $password = "M!kado2014";
    $dbname = "sdvstore";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	    
    $cart_ip = $_SERVER['REMOTE_ADDR'];
    $yesterday = strtotime("yesterday");
    $gift_name = $_POST["gift_name"];
    $gift_address1 = $POST["gift_address1"];
    if(isset($POST["gift_address2"])) {$gift_address2 = $POST["gift_address2"];} else {$gift_address2 = NULL;}
    $gift_product = $POST["gift_product"];
    $gift_price = $POST["gift_price"];
    $gift_options = $POST["gift_options"];
    
    //CLEAN
    $sql = "DELETE FROM cart WHERE add_date < $yesterday";
    $cart_exists = $conn->query($sql);
    $sql = "DELETE FROM gifts WHERE add_date < $yesterday";
    $gift_exists = $conn->query($sql);

    //CREATE
    if($gift_exists != TRUE) {
        //recipient did not exist
        $sql = "CREATE TABLE gifts (gift_name VARCHAR(100) NOT NULL, gift_address1 VARCHAR(225) NOT NULL, gift_address2 VARCHAR(225), add_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";
        if($conn->query($sql) == TRUE) {
            $conn->query("ALTER TABLE `gifts` ADD UNIQUE( `gift_name` )");
        } else {
            //failed to create new recipient
        }
    }
    //ADD
    for($i = 0; $i < $quantity; $i++) {
        $sql = "INSERT INTO gifts (gift_name, gift_address1, gift_address2) VALUES ('$gift_name', '$gift_address1', '$gift_address2') ON DUPLICATE KEY UPDATE gift_address1='$gift_address1', gift_address2='$gift_address2'";
        if($conn->query($sql) == TRUE) {
            //recipient added
        } else {
            //recipient not added
        }
    }
    if($cart_exists) {
        //APPLY
        $sql = "UPDATE cart SET gift_name=$gift_name WHERE product=$gift_product AND price=$gift_price AND options=$gift_options";
        if($conn->query($sql) == TRUE) {
            //updated cart item
        } else {
            //cart not updated
        }
    }
}
?>
<html>
    <form id=continues action=exp_checkout.php></form>
    <script>document.getElementById("continues").submit();</script>
</html>
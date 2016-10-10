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
    $add_new = isset($_POST["add_new"]);
    $cart_contents = "";
    $cart_total = 0.00;
    $num_items = 0;
	//$num_unqitems = 0;
	//$selector_contents = "";
	if(isset($_GET["clear"])) {$conn->query("TRUNCATE TABLE cart");} else {
    
    //CLEAN
    $sql = "DELETE FROM cart WHERE add_date < $yesterday";
    $cart_exists = $conn->query($sql);
    if($add_new) {
		$product = $_POST["product"];
        $price = $_POST["price"];
        $options = $_POST["options"];
        $image = $_POST["image"];
		if(isset($_POST["gift_name"])) { $gift_name = $_POST["gift_name"]; }
		$quantity = $_POST["quantity"];
        //CREATE
        if($cart_exists != TRUE) {
            //cart did not exist
            $sql = "CREATE TABLE cart (product VARCHAR(100) NOT NULL, price DECIMAL(10,2) NOT NULL, options VARCHAR(225), image VARCHAR(225), add_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, quantity INT(10) NOT NULL DEFAULT 1, gift_name VARCHAR(100))";
            if($conn->query($sql) == TRUE) {
                $conn->query("ALTER TABLE `cart` ADD UNIQUE( `product`, `price`, `options`)");
            } else {
                //failed to create new cart
            }
        }
        //ADD
        for($i = 0; $i < $quantity; $i++) {
			if(isset($_POST["gift_name"])) { $sql = "INSERT INTO cart (product, price, options, image, quantity, gift_name) VALUES ('$product', $price, '$options', '$image', 1, '$gift_name') "; }
			else {$sql = "INSERT INTO cart (product, price, options, image, quantity) VALUES ('$product', $price, '$options', '$image', 1) ";}
			$sql .= "ON DUPLICATE KEY UPDATE quantity=quantity+1";
			if($conn->query($sql) == TRUE) {
				//item added
			} else {
				//item not added
			}
		}
    }
    if($cart_exists OR $add_new) {
        //DISPLAY & Total Items
        $sql = "SELECT * FROM cart";
        $results = $conn->query($sql);
		$num_unqitems = $results->num_rows;
        if($num_unqitems > 0) {
            //$num_items = $results->num_rows;
            //save cart contents
			$top_height = 244;
            while($row = $results->fetch_assoc()) {
                $row_image = $row["image"];
                $row_product = $row["product"];
                $row_options = $row["options"];
                $row_price = $row["price"];
				$row_quantity = $row["quantity"];
				//$row_gift_set = isset($row["gift_name"]);
				if(isset($row["gift_name"])) {$row_gift_name = $row["gift_name"];}
                $cart_contents .= "<tr><td><img class=product_image src=$row_image></td><td><b>$row_product</b><br>$row_options<br>Quantity: $row_quantity<br>Price: $$row_price<br></td>";
				if(isset($row["gift_name"])) {$cart_contents .= "<td>$row_gift_name<br>PO Box 408<br>Cville, VA 22901</td>";}
				$cart_contents .= "</tr>";
				$selector_str = "<input type=hidden value=$row_product><input type=hidden value=$row_options><input type=hidden value=$row_price>";
				$selector_contents .= "<div id='item$top_height' onclick='$submit_gift($top_height);' class=item_row_selector style='top:{$top_height}px;'>$selector_str</div>";
				$top_height += 105.5;
				$cart_total += ($row_price * $row_quantity);
				$num_items += $row_quantity;
            }
        } else {
            //cart has no contents!
        }
    }
}
?>
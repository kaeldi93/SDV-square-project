<?php
	require '/home/peggylaw/db-projects/sdvdb-connect.php';
	    
    $cart_ip = $_SERVER['REMOTE_ADDR'];
    $yesterday = strtotime("yesterday");
    $cart_contents = "";
    $cart_total = 0.00;
    $num_items = 0;
	if(isset($_GET["clear"])) {$conn->query("DELETE FROM cart WHERE ip_id='$cart_ip'");
	} else {
		//CLEAN
		$sql = "DELETE FROM cart WHERE add_date < $yesterday";
		$conn->query($sql);
		
		//DISPLAY & Total Items
		$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN gifts ON cart.gift_name = gifts.gift_name WHERE cart.ip_id=?");
		$stmt->bind_param('s', $cart_ip);
		$stmt->execute();
		$results = $stmt->get_result();
		$num_unqitems = $results->num_rows;
		if($num_unqitems > 0) {
			//save cart contents
			$top_height = 244;
			while($row = $results->fetch_assoc()) {
				$row_image = htmlspecialchars($row["image"]);
				$row_product = htmlspecialchars($row["product"]);
				$row_options = htmlspecialchars($row["options"]);
				$row_price = htmlspecialchars($row["price"]);
				$row_quantity = htmlspecialchars($row["quantity"]);
				if(isset($row["gift_name"])) {
					$row_gift_name = htmlspecialchars($row["gift_name"]);
					$row_gift_address1 = htmlspecialchars($row["gift_address1"]);
					$row_gift_address2 = htmlspecialchars($row["gift_address2"]);
					$row_gift_memo = htmlspecialchars($row["gift_memo"]);
					}
				$cart_contents .= "<tr><td><img class=product_image src='$row_image'></td><td><b>$row_product</b><br>$row_options<br>Quantity: $row_quantity<br>Price: $$row_price<br></td>";
				if(isset($row["gift_name"])) {$cart_contents .= "<td>$row_gift_name<br>$row_gift_address1<br>$row_gift_address2<br>$row_gift_memo</td>";}
				$cart_contents .= "</tr>";
				$selector_str = "<input type=hidden name=gift_product value='$row_product'> <input type=hidden name=gift_options value='$row_options'> <input type=hidden name=gift_price value='$row_price'>";
				$selector_contents .= "<div id='item$top_height' onclick=\"submit_gift($top_height);\" onmouseover=\"pop_item($top_height);\" class=item_row_selector style='top:{$top_height}px;'>$selector_str</div>";
				$top_height += 105.5;
				$cart_total += ($row_price * $row_quantity);
				$num_items += $row_quantity;
			}
		} else {
			//cart has no contents!
		}
	}
?>
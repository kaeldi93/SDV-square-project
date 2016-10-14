<html><head></head><body>
    <?php
        $type = $_POST["type"];
        $price = $_POST["amount"];
        //$gift_info = $_POST["gift_info"];
        $gift_name = $_POST["gift_name"];
        
        switch ($type) {
            case "iho": $options = "In Honor Of $gift_name"; break;
            case "imo": $options = "In Memory Of $gift_name"; break;
            case "gift": $options = "Gift for $gift_name"; break;
            case "other": $options = "Designation: $gift_name"; break;
            default: $options = "Thank you!"; break;
        }
        
        //ADD To Cart
        require '/home/peggylaw/db-projects/sdvdb-connect.php';
        $cart_ip = $_SERVER['REMOTE_ADDR'];
        $stmt = $conn->prepare("INSERT INTO cart (product, price, options, image, quantity, ip_id) VALUES ('General Contribution', ?, ?, 'paw.png', 1, ?) ON DUPLICATE KEY UPDATE quantity=quantity+1");
        if(isset($_POST["gift_name"])) { $stmt->bind_param('dss', $price, $options, $cart_ip); }
        else { $nll = null; $stmt->bind_param('dss', $price, $options, $cart_ip); }
        $stmt->execute(); 
    ?>
    <form method=post action=exp_checkout.php id=sad_tr><script>document.getElementById("sad_tr").submit();</script></form></body></html>
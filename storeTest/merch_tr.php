<html><head></head><body>
    <?php
        $product = $_POST["product"];
        $quantity = $_POST["quantity"];
        $style_plus = $_POST["style"];
        $size = $_POST["size"];
        $image = "./merch/" . $_POST["image"];
        $price = $_POST["price"];
        
        $options = substr($style_plus, 0, strpos($style_plus, "-"));
        if(isset($size)) { $options .= " - $size"; }
        
        //ADD To Cart
        require '/home/peggylaw/db-projects/sdvdb-connect.php';
        $cart_ip = $_SERVER['REMOTE_ADDR'];
        $stmt = $conn->prepare("INSERT INTO cart (product, price, options, image, quantity, ip_id) VALUES (?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE quantity=quantity+?");
        $stmt->bind_param('sdssisi', $product, $price, $options, $image, $quantity, $cart_ip, $quantity);
        $stmt->execute();
        
    ?>

    <form method=post action=exp_checkout.php id=sad_tr> <script>document.getElementById("sad_tr").submit();</script> </form></body></html>
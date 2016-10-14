<html><head></head><body>
    <?php
        $level = $_POST["level"]; // like: lvl45 so: substr($_POST["level"], 3);
        $dog = $_POST["dog"];
        
        $price = substr($level, 3);
        $options = "$dog - $$price";
        $image = "sad/$dog.jpg";
        
        
        require '/home/peggylaw/db-projects/sdvdb-connect.php';
        $cart_ip = $_SERVER['REMOTE_ADDR'];
        $stmt = $conn->prepare("INSERT INTO cart (product, price, options, image, quantity, ip_id) VALUES ('Sponsor a Dog', ?, ?, ?, 1, ?) ON DUPLICATE KEY UPDATE quantity=quantity+1");
        $stmt->bind_param('dsss', $price, $options, $image, $cart_ip);
        $stmt->execute();
    ?>

    <form method=post action=exp_checkout.php id=sad_tr>
    <!-- <input type=hidden name=product value="Sponsor a Dog"> -->
    <?php // echo "<input type=hidden name=price value=$level>" ?>
    <?php // echo "<input type=hidden name=options value='$dog - $$level Level'>" ?>
    <?php // echo "<input type=hidden name=image value='sad/$dog.jpg'>" ?>
    <!--<input type=hidden name=quantity value=1>
    <input type=hidden name=add_new value=true>-->
    <script>document.getElementById("sad_tr").submit();</script>
</form></body></html>

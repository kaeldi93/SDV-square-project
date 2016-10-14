<html><head></head><body>
    <?php
        $product = $_POST["product"];
        $quantity = $_POST["quantity"];
        $style_plus = $_POST["style"];
        $size = $_POST["size"];
        $image = "./merch/" . $_POST["image"];
        $price = $_POST["price"];
        
        $desc = substr($style_plus, 0, strpos($style_plus, "-"));
        if(isset($size)) { $desc .= " - $size"; }
        
    ?>

    <form method=post action=exp_checkout.php id=sad_tr>
    <?php echo "<input type=hidden name=product value='$product'>" ?>
    <?php echo "<input type=hidden name=price value=$price>" ?>
    <?php echo "<input type=hidden name=options value='$desc'>" ?>
    <?php echo "<input type=hidden name=image value='$image'>" ?>
    <?php echo "<input type=hidden name=quantity value=$quantity>" ?>
    <input type=hidden name=add_new value=true>
    <script>document.getElementById("sad_tr").submit();</script>
</form></body></html>
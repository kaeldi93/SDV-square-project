<html><head></head><body>
    <?php
        $type = $_POST["type"];
        $amount = $_POST["amount"];
        $gift_info = $_POST["gift_info"];
        
        switch ($type) {
            case "iho": $desc = "In Honor Of $gift_info"; break;
            case "imo": $desc = "In Memory Of $gift_info"; break;
            case "gift": $desc = "Gift for $gift_info"; break;
            case "other": $desc = "QuadraMed Campaign"; break;
            default: $desc = "Thank you!"; break;
        }
    ?>

    <form method=post action=exp_checkout.php id=sad_tr>
    <input type=hidden name=product value="General Contribution">
    <?php echo "<input type=hidden name=price value=$amount>" ?>
    <?php echo "<input type=hidden name=options value='$desc'>" ?>
    <?php echo "<input type=hidden name=image value=paw.png>" ?>
    <?php if (isset($gift_info)) { echo "<input type=hidden name=gift_name value='$gift_info'>"; } ?>
    <input type=hidden name=quantity value=1>
    <input type=hidden name=add_new value=true>
    <script>document.getElementById("sad_tr").submit();</script>
</form></body></html>
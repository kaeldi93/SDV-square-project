<html><head></head><body>
    <?php
        $level = substr($_POST["level"], 3);
        $dog = $_POST["dog"];
    ?>

    <form method=post action=exp_checkout.php id=sad_tr>
    <input type=hidden name=product value="Sponsor a Dog">
    <?php echo "<input type=hidden name=price value=$level>" ?>
    <?php echo "<input type=hidden name=options value='$dog - $$level Level'>" ?>
    <?php echo "<input type=hidden name=image value=sad/$dog.jpg>" ?>
    <input type=hidden name=quantity value=1>
    <input type=hidden name=add_new value=true>
    <script>document.getElementById("sad_tr").submit();</script>
</form></body></html>

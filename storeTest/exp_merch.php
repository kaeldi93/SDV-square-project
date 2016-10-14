<html><head><link rel=stylesheet href=store.css><link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"><script src=store.js></script></head><body><script src=store_menu.js></script><form method=post action=merch_tr.php>
    <?php include 'merch.php'; ?>
    <!-- red: #CE1019; turquoise: #72A68F -->
    <style>
        #right a {cursor:pointer; color:inherit; text-decoration:inherit;}
        #right a:hover {color:#72A68F}
    </style>
    <div id=head>
        <h1><?php if(isset($_GET["product"])) { echo $product; } else { echo "Merchandise"; } ?></h1>
    </div>
    
    <div id=left>
        <p><?php echo $blurb; ?></p>
        <p><b>$<?php echo $price; ?>.00</b><br><em style="font-size:10pt">Includes shipping and handling.</em></p>
        <p><input type=number style="width:40px; font-family:Century Gothic; font-size:16px;" min=1 max=16 name=quantity value=1>
        <select id=style_menu name=style onchange="opt_change();"><?php echo $style_options; ?></select>
        <?php if(strlen($size_options) > 0) echo "<select id=size_menu name=size>$size_options</select>"; ?>
        <input type=submit style="font-family:Century Gothic; font-size:12pt;" value='Add to Cart'></p>
    </div>
    
    <div id=right>
        <div id=la><?php echo "<img id=merch_image style='width:350px; border:solid #FFDB91;' src=./merch/$product_img>"; ?></div>
        <div id=details style=width:175px><?php echo $merch_menu ?></div>
    </div>
<?php
    echo "<input type=hidden id=image_input name=image value='$product_img'>";
    echo "<input type=hidden name=price value=$price>";
    echo "<input type=hidden name=product value='$product'>";
?>
</form>  
</body></html>
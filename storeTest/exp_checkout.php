<html><head>
	<link rel=stylesheet href=store.css>
	<link rel="stylesheet" href="sq.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head><body><script src=store_menu.js>
</script><script src=store.js></script>
<script src="../js/jquery-1.6.2.min.js"></script>
<script src="https://js.squareup.com/v2/paymentform"></script>
<script src="sq.js"></script>

	<?php include 'checkout.php'; ?>
	
	<!--Allow User to Select Items to Apply Recipient To-->
	<div id=select_content style="display:none">
		<div id=popup_cover onclick="popup_close();"></div>
		<div id=select_item style='z-index:51; box-shadow:3px 3px 5px gray;'>
			 <?php echo $selector_contents; ?>
		</div>
	</div>
	
	<!--Add Gift Recipient Popup-->
	<div id=popup_placeholder></div>
	<div id=popup_content style=display:none>
		<div id=popup_cover onclick="popup_close();"></div>
		<div id=popup>
			<span onclick="popup_close();" style="cursor:pointer;"><i style="color:#72A68F" class="fa fa-close"></i></span>
			<center>
				Gift Recipient
				<form id=gift_form method=post action=add_gift.php>
				<input type=hidden id=gift_product name=gift_product value=""><input type=hidden id=gift_price name=gift_price value=""><input type=hidden id=gift_options name=gift_options value="">
				<input name=gift_name size=25 type=text placeholder="Full Name"><br>
				<input name=gift_address1 size=25 type=text placeholder="Street Address, Opt Apt. #"><br>
				<input name=gift_address2 size=25 type=text placeholder="City, ST 00000"><br>
				<p><button type=button onclick="select_display();">Add</button>
				</form>
			</center>
		</div>
	</div>

    <div id=head><h1>Checkout</h1></div>
    
    <div id=left>
        <p>
        <span  id=popup_link onclick="popup();" href=exp_checkout.php?gift=true><i class="fa fa-gift"></i> Add Gift Recipient</span> | <a style="color:inherit; text-decoration:inherit;" href="exp_donate.html"><i class="fa fa-paw"></i> Add Donation</a> | <a style="color:inherit; text-decoration:inherit;" href="exp_checkout.php?clear=true"><i class="fa fa-trash"></i> Clear Cart</a><br>
        <p><table style=width:400px;><?php echo $cart_contents; ?></table>
        <p><b>Total: $<?php echo $cart_total; ?></b> | Items: <?php echo $num_items; ?></p>
    </div>
    
    <div id=right>
		<p>
        <form method="post" action="processing.php">
		<table>
            <tr>
                <td width=70>First Name</td>
                <td width=150><input name=firstName size=20 type=text required="required"></td>
                <td width=74>Last Name</td>
                <td width=150><input name=lastName size=20 type=text required="required"></td></tr></table>
		<table><tr>	<td width=70>Address</td> <td><input name=addressL1 size=58 type=text required="required"></td></tr>
			   <tr>	<td></td><td><input name=addressL2 size=58 type=text></td></tr></table>
		<table><tr>	<td width=70>City</td><td width=150><input name=city size=20 type=text required="required"></td>
                    <td>State</td><td width=78><select name="state" style="font-size:11pt">
                        <option value="AL">AL</option><option value="AK">AK</option><option value="AZ">AZ</option>
                        <option value="AR">AR</option><option value="CA">CA</option><option value="CO">CO</option>
                        <option value="CT">CT</option><option value="DE">DE</option><option value="FL">FL</option>
                        <option value="GA">GA</option><option value="HI">HI</option><option value="ID">ID</option>
                        <option value="IL">IL</option><option value="IN">IN</option><option value="IA">IA</option>
                        <option value="KS">KS</option><option value="KY">KY</option><option value="LA">LA</option>
                        <option value="ME">ME</option><option value="MD">MD</option><option value="MA">MA</option>
                        <option value="MI">MI</option><option value="MN">MN</option><option value="MS">MS</option>
                        <option value="MO">MO</option><option value="MT">MT</option><option value="NE">NE</option>
                        <option value="NV">NV</option><option value="NH">NH</option><option value="NJ">NJ</option>
                        <option value="NM">NM</option><option value="NY">NY</option><option value="NC">NC</option>
                        <option value="ND">ND</option><option value="OH">OH</option><option value="OK">OK</option>
                        <option value="OR">OR</option><option value="PA">PA</option><option value="RI">RI</option>
                        <option value="SC">SC</option><option value="SD">SD</option><option value="TN">TN</option>
                        <option value="TX">TX</option><option value="UT">UT</option><option value="VT">VT</option>
                        <option value="VA" selected="selected">VA</option><option value="WA">WA</option>
                        <option value="WV">WV</option><option value="WI">WI</option><option value="WY">WY</option>
                        </select></td>
                    <td>Zip</td><td><input name="zipCode" id=postalCode size=11 type=text></td></tr></table>
		<table><tr>	<td width=70>Phone</td><td width=150><input name=phone type=tel required="required"></td>
                    <td width=74>Email</td><td><input name=email type=email required="required"></td></tr></table>
		<p>
		<hr>
		<table><tr><td width=70>Card #</td><td width=150><input id=cardNumber type=text></td></tr>
			   <tr><td>Exp Date</td><td><input id=expDate type=text></td>
               <td>CVV</td><td><input id=cVV size=7 type=text></td></tr></table>
		<p>
		<button id="donate1" type="button" onclick="requestCardNonce();"><b>Submit Payment</b></button>
        <!--Hidden fields-->
        <input name=product type=hidden value="<?php echo $_POST['product_name']; ?>" >
		<input name=option_1 type=hidden value="<?php echo $_POST['shirt_color']; ?>" >
		<input name=option_2 type=hidden value="<?php echo $_POST['current_sizes']; ?>" >
		<input name=price type=hidden value="<?php echo $_POST['product_price']; ?>" >
		<input name=quantity type=hidden value="<?php echo $_POST['quantity']; ?>">
		<input id="nonce_capture" name="nonce_capture" type=hidden value="">
		<input id="hidden_zip" name="hidden_zip" type=hidden value="">
		<input id="last_four" name="last_four" type=hidden value="">
		<input id="card_type" name="card_type" type=hidden value="">
        <!--End Hidden Fields-->
		<input id="donate2" style="visibility:hidden" type="submit" value="Confirm Payment"><br><em>All fields are required.</em>
		</form>
		<br><img style="margin:0px 0px 0px 0px; padding: 0px 0px 0px 0px; border:none;" src="sq_brand.jpg" alt="Built with Square" width="100">
		
		</div>
    </div>
    
</body></head></html>
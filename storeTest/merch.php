<?php
        require '/home/peggylaw/db-projects/sdvdb-connect.php';
        
        //LIST OF MERCHANDISE (merch_menu)
        $merch_menu = "";
        
        $sql = "SELECT product, product_id, image FROM merch";
        $results = $conn->query($sql);
        if($results->num_rows > 0) {
            while( $row = $results->fetch_assoc()) {
                $row_product = $row["product"];
                $row_id = $row["product_id"];
                $merch_menu .= "<p style='font-family: Century Gothic; font-size:15pt'><a href='https://servicedogsva.org/storeTest/exp_merch.php?product=$row_id'><i class='fa fa-paw'></i> $row_product</a>";
            }
        }
        
        //CREATE DISPLAY (product, price, blurb, image, style_options, size_options)
        $product = "";
        $price = 0.00;
        $blurb = "";
        $product_img = "";
        $style_options = "";
        $size_options = "";
        
        $product_id = $_GET["product"];
        $stmt = $conn->prepare("SELECT * FROM merch WHERE product_id=$product_id");
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $results = $stmt->get_result();
        if($results->num_rows > 0) {
            $row = $results->fetch_assoc();
            $product = $row["product"];
            $price = $row["price"];
            $blurb = $row["blurb"];
            if(isset($row["image"])) { $product_img = $row["image"];}
            if($row["category"] == 'shirt') {
                
                //set t-shirt display
                $stmt = $conn->prepare("SELECT option_name, sizes, selected FROM merch_options WHERE product_id=?");
                $stmt->bind_param('i', $product_id);
                $stmt->execute();
                $results = $stmt->get_result();
                if($results->num_rows > 0) {
                    while($row = $results->fetch_assoc()) {
                        $option_name = $row["option_name"];
                        $sizes = $row["sizes"];
                        if($row["selected"] == 1) {
                            $size_array = ["Small (SM)", "Medium (MED)", "Large (LG)", "X-Large (XL)", "2X-Large (2XL)"];
                            for($i = 0; $i < 5; $i++) {
                                $s_a = $size_array[$i];
                                if(substr($sizes, $i, 1) == 1) $size_options .= "<option value='$s_a'>$s_a</option>";
                            }
                            $style_options .= "<option value='$option_name-$sizes' selected>$option_name</option>";
                        } else { $style_options .= "<option value='$option_name-$sizes'>$option_name</option>"; }
                        
                    }
                } else {
                    //no options found
                }
            } else {
                
                //set other display
                $results = $conn->query("SELECT option_name, image, selected FROM merch_options WHERE product='$product'");
                if($results->num_rows > 0) {
                    while($row = $results->fetch_assoc()) {
                        $option_name = $row["option_name"];
                        $image = $row["image"];
                        if($row["selected"] == 1) {
                            $product_img = $image;
                            $style_options .= "<option value='$option_name-$image' selected>$option_name</option>";
                        } else { $style_options .= "<option value='$option_name-$image'>$option_name</option>"; }
                        
                    }
                } else {
                    //no options found
                }
            }
            
        } else {
            //merchandise not found!!
        }
    ?>
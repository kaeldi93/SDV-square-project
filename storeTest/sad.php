<?php
        $servername = "mysql.servicedogsva.org";
        $username = "ked9ua";
        $password = "M!kado2014";
        $dbname = "sdvstore";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
        
        $dog_table = "";
        
       //SELECT DOG INFORMATION
        $sql = "SELECT * FROM sad WHERE class=2016";
        $results = $conn->query($sql);
        if($results->num_rows > 0) {
            for($i = 0; $row = $results->fetch_assoc(); $i++) {
                $dog = $row["dog"];
                $blurb = $row["blurb"];
                
                if($i == 0) { $dog_table .= "<tr>"; } //before first image
                if($i == 4) { $dog_table .= "</tr><tr>"; } //before fifth image
                $dog_table .= "<td><img onmouseover=\"blurbs('$dog');\" onmouseout=\"blurbhide('$dog');\" src='./sad/$dog.jpg'><br><input type=radio name=\"dog\" value='$dog' required>$dog</input></td>";
                if($i == 7) { $dog_table .= "</tr>"; } //after eighth image
                
                echo "<div id='dog$dog' style=display:none>$blurb</div>";
            }
        } else {
            //No Dogs Found in Class
        }
?>
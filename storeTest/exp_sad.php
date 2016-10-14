<html><head><link rel=stylesheet href=store.css><script src=store.js></script></head><body><script src=store_menu.js></script><form method=post action=sad_tr.php>

    <?php include "sad.php" ?>

    <div id=head><h1>Sponsor a Dog</h1></div>

    <div id=left>
        <p>By sponsoring a service dog you will share in the training journey and you will receive special insider email updates on the pup's progress and a professional photo of your dog. </p>
        <div id=la><br>
                Level<br><select onchange="perks();" name=level id="level">
                    <option value=lvl45>$45</option>
                    <option value=lvl65>$65</option>
                    <option value=lvl150>$150</option>
                    <option value=lvl250>$250</option>
                    <option value=lvl500>$500</option>
                    <option value=lvl1000>$1000</option>
                </select>
        </div>
        <div id="details">
            <ul>
                <li>Certificate signed by Service Dogs of Virginia Founder, Peggy Law</li>
                <li>4 x 6 color photo of the dog you are sponsoring</li>
                <li>Email updates on your dog</li><br>
                <span id=current_level></span>
                <span class=sh id=lvl45></span>
                <span class=sh id=lvl65>
                    <b>All of the above, <em>plus...</em></b>
                    <li class=lvl65>5 x 7 paw painting</li>
                </span>
                <span class=sh id=lvl150>
                    <b>All of the above, <em>plus...</em></b>
                    <li class=lvl150>8 x 10 paw painting</li>
                    <li class=lvl150>Set of 8 note cards featuring Service Dogs in training</li>
                </span>
                <span class=sh id=lvl250>
                    <b>All of the above, <em>plus...</em></b>
                    <li class=lvl250>11 x 14 paw painting</li>
                    <li class=lvl250>Two sets of 8 note cards featuring Service Dogs in training</li>
                </span>
                <span class=sh id=lvl500>
                    <b>All of the above, <em>plus...</em></b>
                    <li class=lvl250>11 x 14 paw painting</li>
                    <li class=lvl250>Two sets of 8 note cards featuring Service Dogs in training</li>
                    <li class=lvl500>Recognition at our Annual Graduation Event</li>
                </span>
                <span class=sh id=lvl1000>
                    <b>All of the above, <em>plus...</em></b>
                    <li class=lvl250>11 x 14 paw painting</li>
                    <li class=lvl250>Two sets of 8 note cards featuring Service Dogs in training</li>
                    <li class=lvl500>Recognition at our Annual Graduation Event</li>
                    <li class=lvl1000>Dog Demos and Dessert!<br><em>Saturday, April 29, 2017 at 3PM at the training center</em></li>
                </span> 
            </ul>
        </div>
        <div id=left_end><center><input id=don_submit type=submit value="Donate Now"></center></div>
    </div>
    
    <div id=right>
        <table id=sad><?php echo $dog_table; ?></table>
     </div>
</form>  
</body></html>
//CHECKOUT FUNCTIONS
function popup() {
    var x = document.getElementById("popup_content");
    var y = document.getElementById("popup_placeholder");
    y.innerHTML = x.innerHTML;
}
function popup_close() {
    document.getElementById("popup_placeholder").innerHTML = "";
}
function select_display() {
    var x = document.getElementById("select_content");
    var y = document.getElementById("popup_placeholder");
    var item_container = y.children[1].children[1].getElementsByTagName("input");
    while(item_container.length > 0) { document.getElementById("gift_form").appendChild(item_container[0]);}
    y.innerHTML = x.innerHTML;
}

function submit_gift(height_val) {
    var item_container = document.getElementById("item" + height_val).children;
    while(item_container.length > 0) {
        document.getElementById("gift_form").appendChild(item_container[0]);
    }
    gift_form.submit();   
}


//SAD FUNCTIONS
function perks() {
    var y = document.getElementById("level");
    var z = y.options[y.selectedIndex].value;
    var x = document.getElementById(z);
    var to_switch = x.innerHTML;
    document.getElementById("current_level").innerHTML = to_switch;
}

//These functions control the display of dog information on mouseover of pictures
var leftHold = {};
var i = 0;
var s = {};

function blurbs(x) {
    y = document.getElementById("left");
    y.style.opacity = 1;
    leftHold[i] = y.innerHTML;
    s[i] = document.getElementById("level").value;
    getBlurb(x);
}

function getBlurb(x) {
    var z = "<span>".concat(x, "</span>", document.getElementById("dog" + x).innerHTML);
    
    document.getElementById("la").innerHTML = "<img src='./sad/".concat(x,".jpg'>");
    document.getElementById("details").style.width = "60%";
    document.getElementById("details").innerHTML = "<span id=blurb>".concat(z,"</span>");
    document.getElementById("left_end").innerHTML = "";
}

function blurbhide() {
    y = document.getElementById("left");
    y.style.opacity = 0;
    y.innerHTML = leftHold[0];
    document.getElementById("level").value = s[0];
    setTimeout(function() {y.style.opacity = 1;}, 150);
}

//MERCH FUNCTIONS
function opt_change() {
    var style_menu = document.getElementById("style_menu");
    var style = style_menu.options[style_menu.selectedIndex];
    var changes = style.value.replace(style.text + "-", "");
    
    if(changes.charAt(changes.length-4) == ".") {
        document.getElementById("merch_image").src = "./merch/" + changes;
        document.getElementById("image_input").value = changes;
    } else {
        var size_menu = document.getElementById("size_menu");
        while(size_menu.hasChildNodes()) {
            size_menu.removeChild(size_menu.firstChild);
        }
        var size_array = ["Small (SM)", "Medium (MED)", "Large (LG)", "X-Large (XL)", "2X-Large (2XL)"];
        for(var i = 0; i < 5; i++) {
            if(changes.charAt(i) == "1") {
                var opt = document.createElement("option");
                opt.value = size_array[i];
                opt.appendChild(document.createTextNode(size_array[i]));
                size_menu.appendChild(opt);
            }
        }
    }
}

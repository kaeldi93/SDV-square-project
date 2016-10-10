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
    y.innerHTML = x.innerHTML;
}
function submit_gift(height_val) {
    var item_id = "item" + height_val;
    var item_container = document.getElementById(item_id).children;
    
    var item_product = document.createElement("input");
    var item_options = document.createElement("input");
    var item_price = document.createElement("input");
    item_product.type = 'hidden';
    item_product.name = 'hidden';
    item_options.type = 'hidden';
    item_options.type = 'hidden';
    
    //var item_product = item_container[0].value;
    //var item_options = item_container[1].value;
    //var item_price = item_container[2].value;
    
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
    var z;
    var y = "https://servicedogsva.org/storeTest/sad/";
    
    switch (x.src) {
      case y.concat("Clay.jpg"): z = "<span>Clay's</span> puppy raiser describes him as having a happy heart. He is an easy-going guy who adapts to new situations. He is affectionate in giving kisses and getting belly rubs and is working hard on curbing his enthusiasm when he meets new people. His puppy raiser has years of experience and finds Clay a pleasure. He displays a strong nose so may have a future in diabetic alert work but it's too soon for us to know his ultimate career path."; break;
      case y.concat("Mica.jpg"): z = "<span>Mica</span>, quickly recognized by his odd coat, which is rough and curly, looks like he is perpetually having a bad hair day. He is sweet and loves to cuddle. When he understands what is being asked of him, he is happy to oblige. Mica is unafraid of meeting a strange dog or weird Halloween props, but he can lose it over a stuffed animal or a nickel-sized hole in the floor. We will help him sort it out as he has the potential to make an accomplished service dog."; break;
      case y.concat("Andre.jpg"): z = "<span>Andre</span> is a solid little worker who learns quickly and enjoys every moment of it. He goes everywhere with his first-time puppy raiser: school events, grocery shopping, and he is the star of her book club. Andre has a shoe fetish. He loves to carry them but does no damage. Andre is a good example of what we like to see in a pup. He is sweet, enthusiastic about learning, confident, and adorable. Andre's puppy raiser feels fortunate to have him show her the ropes."; break;
      case y.concat("Aspen.jpg"): z = "<span>Aspen</span> is a very special dog and here is why. Two years ago our accrediting organization, Assistance Dogs International launched a voluntary member-driven breeding cooperative. The co-op goal is to improve the quality of puppies available to service and guide dog programs through selective breeding for ideal behavioral and health traits. Aspen is our first female to be bred in the co-op. On September 28th, she had eight healthy puppies: four males and four females. By co-op rules, we will keep four and send four to other dog schools."; break;
      case y.concat("Cobalt.jpg"): z = "<span>Cobalt</span> thinks the world is a big party put on for his benefit! He is impulsive, energetic, and full of glee. The good news is that he can totally pull himself together when needed. Recently, he attended a crowded outdoor wedding, went through the buffet line, and was the perfect guest. He is crazy about water especially when it's coming out of a hose. He is a natural with scent work and executes a perfect search to locate a ball in the yard. Cobalt sports a darker color known as butterscotch; he's a handsome young Lab full of promise."; break;
      case y.concat("Ella.jpg"): z = "<span>Ella</span> was released to us from the Guide Dog Foundation earlier this year. They look for dogs that are leaders and Ella looks intently for direction and challenge. Energetic, she has great enthusiasm for work and is extremely smart. She is a bit older than the others in her class, therefore more mature and able to concentrate for longer periods of time. Chosen to go into our diabetic alert program, she breezed through retrieve work, quickly learned to open doors, grab a diabetic kit with supplies and bring it to her trainer. She is alerting well to the diabetic low scent at our training center so we will increase the level of difficulty by asking her to alert in more distracting environments. The odor of low blood sugar must trump everything else going on around her."; break;
      case y.concat("Irene.jpg"): z = "<span>Irene</span> is named for Irene Dubois, in honor of her 103rd birthday. Pup Irene is a spirited, fearless girl with a twinkle in her eye and a strong work ethic. She loves to train and is a quick learner. Irene tackles problems head on and is gifted in scent work even at a very young age. Her spunkiness needs some self-control and she will likely mature slowly, which is fine. Small in stature, Irene has a huge personality."; break;
      case y.concat("Zinc.jpg"): z = "<span>Zinc</span> is a gentle soul who loves to meet new people but truly adores his puppy raiser the most. He gets a bit upset if left alone so we are working on building his confidence when he is left for short periods. He is as steady as they come on outings and handles himself with little management from his raiser. He needs to have a quicker response to some cues, tending to be a little too laid back. As a little guy he learned to navigate the pool on a floatie before turning into an avid swimmer!"; break;
      default: z = x.src;
    }
    document.getElementById("la").innerHTML = "<img src=".concat(x.src,">");
    document.getElementById("details").style.width = "60%";
    document.getElementById("details").innerHTML = "<span id=blurb>".concat(z,"</span>");
}

function blurbhide() {
    y = document.getElementById("left");
    y.style.opacity = 0;
    y.innerHTML = leftHold[0];
    document.getElementById("level").value = s[0]
    setTimeout(function() {y.style.opacity = 1;}, 150);
}

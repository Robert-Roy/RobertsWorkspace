$(document).ready(function () {

    //canvas init
    var $canvas;
    $('#main').append("<canvas id='canvas'\n\style='\n\
        position:fixed;\n\
        display:block;\n\
        height: 100%;\n\
        z-index:0;\n\
        top:50%;\n\
        left:50%;\n\
        -webkit-transform:translate(-50%, -50%);\n\
        transform:translate(-50%, -50%);\n\
        width: 100%;'></canvas>");
    $canvas = $('#canvas');
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");
    var W = $canvas.width();
    var H = $canvas.height();
    canvas.width = W;
    canvas.height = H;
    var mp = H * W / 2000; // max particles
    //color init
    var red = 13;
    var green = 110;
    var blue = 110;
    blue = Math.round(Math.random() * 200 + 25);
    green = Math.round(Math.random() * 200 + 25);
    red = Math.round(Math.random() * 200 + 25);

    //particle init
    var particles = makeParticles([], 0, 0, W, H, mp);

    function draw() {
        context.clearRect(0, 0, W, H);
        // drift colors
        //todo smooth random color changes and clean code
        if (red + green + blue > 500) {
            red += -4 * Math.random();
            green += 4 * -4 * Math.random();
            blue += 4 * -4 * Math.random();
        } else if (red + green + blue < 300) {
            red += 4 * Math.random();
            green += 4 * Math.random();
            blue += 4 * Math.random();
        } else {
            red += Math.random() * 8 - 4;
            green += Math.random() * 8 - 4;
            blue += Math.random() * 8 - 4;
        }
        context.fillStyle = "rgba(" + Math.round(red) + "," + Math.round(green) + "," + Math.round(blue) + ", 1)";
        context.beginPath();
        for (var i = 0; i < particles.length; i++) {
            var p = particles[i];
            context.moveTo(p.x, p.y);
            context.arc(p.x, p.y, p.r, 0, Math.PI * 2, true);
        }
        context.fill();
        update();
    }

    function update() {
        for (var i = 0; i < particles.length; i++, mp) {
            var p = particles[i];
            // gradually slow down movement to prevent very fast particles
            p.mx = p.mx * .99;
            p.my = p.my * .99;
            //build momentum in random directions
            p.a = Math.random() * (Math.PI * 2); // angle
            p.my += .001 * Math.cos(p.a) * p.d;
            p.mx += .001 * Math.sin(p.a) * p.d;
            //move according to momentum
            p.x += p.mx;
            p.y += p.my;
            // screen wrap (top and bottom)
            if (p.x > W + p.r) {
                p.x = 0 - p.r;
            } else if (p.x < 0 - p.r) {
                p.x = W + p.r;
            } else if (p.y > H + p.r) {
                p.y = 0 - p.r;
            } else if (p.y < 0 - p.r) {
                p.y = H + p.r;
            } else if (false) {
                particles.splice(i, 1);
                i--;
            }
            ;
        }
    }
    setTimeout(setInterval(draw, 33), 50);
    $(window).resize(function () {
        // prevents canvas stretching.
        // TODO: add or remove particles according to resize (currently makes ugly lines)
        canvas.width = $(window).width();
        canvas.height = $(window).height();
        var oldW = W;
        var oldH = H;
        W = $canvas.width();
        H = $canvas.height();
        var oldmp = mp;
        mp = H * W / 2000; // max particles
        var newParticleCount = mp - oldmp;
        var particlesRight = (W - oldW) * H / 2000;
        var particlesBottom = (H - oldH) * oldW / 2000;
        if (oldH < H) {
            //draw new particles in new height, NOT including the corner of right and bottom added strip
            particles = makeParticles(particles, 0, oldW, oldH, H, particlesBottom);
        } else {
            particles = removeParticles(particles, true, oldH, H);
        }
        if (oldW < W) {
            particles = makeParticles(particles, oldW, W, 0, H, particlesRight);
        } else {
            particles = removeParticles(particles, false, oldW, W);
        }
    });
});

function removeParticles(particles, blnYAxis, startVal, endVal) {
    for (var i = 0; i < particles.length; i++) {
        if (blnYAxis) {
            var currentValue = particles[i].y;
        } else {
            var currentValue = particles[i].x;
        }
        if ((startVal < currentValue && currentValue < endVal)) {
            particles.splice(i, 1);
            i--;
        }
    }
    return particles;
}

function makeParticles(particles, startX, startY, endX, endY, maxParticles) {
    for (var i = 0; i < maxParticles; i++) {
        particles.push(makeParticle(startX, startY, endX, endY));
    }
    return particles;
}
function makeParticle(startX, startY, endX, endY) {
    return {
        x: Math.random() * (endX - startX) + startX, //start X
        y: Math.random() * (endY - startY) + startY, //start Y
        mx: Math.random() * .25 - .125, //momentum x
        my: Math.random() * .25 - .125, //momentum y
        r: Math.random() + .3, //radius
        d: Math.random() * 25 + 2, //density
        a: Math.random() * (Math.PI * 2) // angle
    };
}
$(window).load(function () {
    var cursorX = -50;
    var cursorY = -50;
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
    var mp = (H * W) / 2000; // max particles

    //color init
    var red = Math.random() * 150 + 100;
    var green = Math.random() * 150 + 100;
    var blue = Math.random() * 150 + 100;

    //particle init
    var particles = makeParticles([], 0, 0, W, H, mp);

    //begin drawloop after 25ms (prevents lag)
    setTimeout(setInterval(draw, 33), 25);

    function draw() {
        context.clearRect(0, 0, W, H);
        // drift colors
        if (red + green + blue > 500) {
            red += -4 * Math.random();
            green += 4 * -4 * Math.random();
            blue += 4 * -4 * Math.random();
        } else if (red + green + blue < 400) {
            red += 4 * Math.random();
            green += 4 * Math.random();
            blue += 4 * Math.random();
        } else {
            red += Math.random() * 8 - 4;
            green += Math.random() * 8 - 4;
            blue += Math.random() * 8 - 4;
        }
        //todo smooth random color changes and clean code
        //context.fillText(particles.length + "/" + mp, 10, 50); //shows current particles and max particles
        for (var i = 0; i < particles.length; i++) {
            context.beginPath();
            var p = particles[i];
            context.fillStyle = "rgba(" + Math.round(p.red + red)
                    + "," + Math.round(p.green + green) +
                    "," + Math.round(p.blue + blue) + ", 1)";
            context.moveTo(p.x, p.y);
            context.arc(p.x, p.y, p.r + p.extraRadius, 0, Math.PI * 2, true);
            context.fill();
            context.closePath();
        }
        //circle mouse
        //context.beginPath();
        //context.moveTo(cursorX, cursorY);
        //context.arc(cursorX, cursorY, 50, 0, Math.PI * 2, false);
        //context.lineWidth = 1;
        //context.strokeStyle = 'rgba(255, 255, 255, .2)';
        //context.stroke();
        //context.closePath();
        update();
    }

    function update() {
        for (var i = 0; i < particles.length; i++) {
            var p = particles[i];
            p.a = Math.random() * (Math.PI * 2); // angle
            var distanceFromMouseX = cursorX - p.x;
            var distanceFromMouseY = cursorY - p.y;
            var distanceFromMouse = Math.sqrt(Math.pow(distanceFromMouseX, 2) + Math.pow(distanceFromMouseY, 2));
            if (distanceFromMouse < 50) {
                p.a = Math.PI + Math.atan2(distanceFromMouseX, distanceFromMouseY);
                if (p.extraRadius < (50 - distanceFromMouse) / 10)
                    p.extraRadius += .1;
            } else if (p.extraRadius > 0) {
                p.extraRadius -= .1;
            }
            //gradually shift color
            // gradually slow down movement to prevent very fast particles
            p.mx = p.mx * .99;
            p.my = p.my * .99;
            //build momentum in random directions
            p.my += .001 * Math.cos(p.a) * p.d;
            p.mx += .001 * Math.sin(p.a) * p.d;
            //move according to momentum
            p.x += p.mx;
            p.y += p.my;
            // screen wrap (top and bottom)
            var totalRadius = p.r + p.extraRadius;
            if (p.x > W + totalRadius) {
                p.x = 0 - totalRadius;
            } else if (p.x < 0 - totalRadius) {
                p.x = W + totalRadius;
            } else if (p.y > H + totalRadius) {
                p.y = 0 - totalRadius;
            } else if (p.y < 0 - totalRadius) {
                p.y = H + totalRadius;
            }
            ;
        }
    }

    $(window).resize(function () {
        // prevents canvas stretching.
        // TODO: add or remove particles according to resize (currently makes ugly lines)
        canvas.width = $(window).width();
        canvas.height = $(window).height();
        var oldW = W;
        var oldH = H;
        W = $canvas.width();
        H = $canvas.height();
        mp = (H * W) / 2000; // max particles
        var addedWidth = W - oldW;
        var addedHeight = H - oldH;
        var particlesRight = ((addedWidth) * H) / 2000;
        var particlesBottom = ((addedHeight) * oldW) / 2000;
        // if a large change was made to dimensions, redraw. Otherwise, modify current)
        if (Math.abs(addedWidth) > 25 || Math.abs(addedHeight > 25)) {
            particles = makeParticles([], 0, 0, W, H, mp);
        } else {
            if (oldH < H) {
                //draw new particles in new height, NOT including the corner of right and bottom added strip
                particles = makeParticles(particles, 0, oldH, oldW, H, particlesBottom);
            } else if (oldH > H) {
                particles = removeParticles(particles, true, oldH, H);
            }
            if (oldW < W) {
                //draw new particles between top and bottom of the screen in new width
                particles = makeParticles(particles, oldW, 0, W, H, particlesRight);
            } else if (oldW > W) {
                particles = removeParticles(particles, false, oldW, W);
            }
            var particlesTooMany = particles.length - mp;
            //removes particles if there are too many
            for (i = 0; i < particlesTooMany; i++) {
                particles.splice(Math.round(Math.random() * particles.length - 1), 1);
            }
            // Adds particles if there are too few
            particles = makeParticles(particles, 0, 0, W, H, -particlesTooMany);
        }

    });
    $(document).mousemove(function (e) {
        cursorX = e.clientX;
        cursorY = e.clientY;
    })
});


function cleanEdges(particles, width, height) {
    // clears the edge of particles
    for (var i = 0; i < particles.length; i++) {
        p = particles[i];
        if (p.x > width - 2 || p.x < 2 || p.y > height - 2 || p.y < 2) {
            p = makeParticle(0, 0, width, height);
        }
        return particles;
    }
}

function removeParticles(particles, blnYAxis, startVal, endVal) {
    // removes particles in a given range
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

function makeParticles(particles, startX, startY, endX, endY, makeThisManyParticles) {
    // generates a bunch of particles in a given range
    for (var i = 0; i < makeThisManyParticles; i++) {
        particles.push(makeParticle(startX, startY, endX, endY));
    }
    return particles;
}

function makeParticle(startX, startY, endX, endY) {
    // generates a particle in a given range
    return {
        x: Math.random() * (endX - startX) + startX, //start X
        y: Math.random() * (endY - startY) + startY, //start Y
        mx: Math.random() * .25 - .125, //momentum x
        my: Math.random() * .25 - .125, //momentum y
        r: Math.random() + .3, //radius
        extraRadius: 0, //extra radius added by being near mouse
        d: Math.random() * 25 + 2, //density
        a: Math.random() * (Math.PI * 2), // angle
        red: Math.random() * 32 - 16,
        green: Math.random() * 32 - 16,
        blue: Math.random() * 32 - 16
    };
}

function cot(x) {
    return 1 / Math.tan(x);
}
function arctan(x) {
    return Math.PI / 2 - Math.atan(x);
}
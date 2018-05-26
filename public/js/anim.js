$(window).load(function () {
    var PARTICLE_RATIO = 2000; // 1 particle per PARTICLE_RATIO pixels 2000 default
    var DEBUG = false;
    var FPS = 30;
    var DRAW_SPEED = 1000 / FPS;
    var DRAW_WAIT = 25; //wait X MS to start drawing

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
    var maxParticles = (H * W) / PARTICLE_RATIO; // max particles

    //color init
    var red = Math.random() * 150 + 100;
    var green = Math.random() * 150 + 100;
    var blue = Math.random() * 150 + 100;

    //regulates particles
    var thisLoopMS;
    var lagThisManyLoopsInARow = 0;

    //particle init
    var particles = addParticlesToArray([], 0, 0, W, H, maxParticles);

    //begin drawloop after 25ms (prevents lag)
    setTimeout(setInterval(loop, DRAW_SPEED), DRAW_WAIT);

    var isRunning = true;
    function loop() {
        if(isRunning){
            return;
        }
        isRunning = true;
        thisLoopMS = new Date().getTime();
        draw();
        update();
        checkFPS();
        if (DEBUG) {
            showDebugText();
        }
        isRunning = false;
    }
    function showDebugText() {
        context.fillText(particles.length + "/" + maxParticles, 10, 50); //shows current particles and max particles
    }
    function draw() {
        context.clearRect(0, 0, W, H);
        //todo smooth random color changes and clean code
        for (var i = 0; i < particles.length; i++) {
            context.beginPath();
            var p = particles[i];
            context.fillStyle = "rgba(" + Math.round(p.red + red)
                    + "," + Math.round(p.green + green) +
                    "," + Math.round(p.blue + blue) + ", "
                    + p.opacity + ")";
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
    }

    function update() {
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
            if (p.opacity < 1) {
                p.opacity += .1;
            }
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
    function checkFPS() {
        var rightNow = new Date().getTime();
        var loopTime = rightNow - thisLoopMS;
        if (loopTime < .1 * DRAW_SPEED) {
            PARTICLE_RATIO = PARTICLE_RATIO * .95;
            updateMaxParticles();
            particles = pushToMaxParticles(particles, maxParticles);
            //add more particles
        }
        if (loopTime > DRAW_SPEED * .5) {
            lagThisManyLoopsInARow++;
            if (lagThisManyLoopsInARow > 2) {
                PARTICLE_RATIO = PARTICLE_RATIO * 1.05;
                lagThisManyLoopsInARow = 0;
            }
            if (loopTime > DRAW_SPEED * 6) {
                PARTICLE_RATIO = PARTICLE_RATIO * 5;
            }
        }
        if (DEBUG) {
            context.fillText(loopTime + "/" + DRAW_SPEED, 10, 100); //shows current particles and max particles
        }
    }

    function updateMaxParticles() {
        maxParticles = (H * W) / PARTICLE_RATIO; // max particles
    }
    function pushToMaxParticles(particles, maxParticles) {
        return addParticlesToArray(particles, 0, 0, W, H, maxParticles - particles.length);
    }

    $(window).resize(function () {
        // prevents canvas stretching.
        // TODO: add or remove particles according to resize (currently makes ugly lines)
        canvas.width = $(window).width();
        canvas.height = $(window).height();
        W = $canvas.width();
        H = $canvas.height();
        updateMaxParticles();
        particles = addParticlesToArray([], 0, 0, W, H, maxParticles);

    });
    $(document).mousemove(function (e) {
        cursorX = e.clientX;
        cursorY = e.clientY;
    })
});

function removeExtraParticles(particles, maxParticles) {
    var particlesTooMany = particles.length - maxParticles;
    for (i = 0; i < particlesTooMany; i++) {
        particles.splice(Math.round(Math.random() * particles.length - 1), 1);
    }
    return particles;
}


function removeParticlesInRectangle(particles, blnYAxis, startVal, endVal) {
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

function addParticlesToArray(particles, startX, startY, endX, endY, makeThisManyParticles) {
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
        blue: Math.random() * 32 - 16,
        opacity: 0
    };
}

/*
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
 */
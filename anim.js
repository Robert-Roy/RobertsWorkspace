
var $canvas;
var W = window.innerWidth;
var H = window.innerHeight;
$(document).ready(function () {
    $('#main').append("<canvas id='canvas'\n\style='\n\
        position:absolute;\n\
        display:block;\n\
        height:" + window.innerHeight + "px;\n\
        z-index:0;\n\
        left:0;\n\
        top:0;\n\
        width:" + window.innerWidth + "px;'></canvas>");
    //canvas init
    $canvas = $('#canvas');
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");
    //canvas dimensions
    W = $('body').width();
    H = $('body').height();
    canvas.width = W;
    canvas.height = H;
    var mp = 250;
    var particles = [];
    for (var i = 0; i < mp; i++) {
        particles.push({
            x: W / 2,
            y: H / 2,
            r: Math.random() * 4 + 2,
            d: Math.random() * 25 + 1,
            a: Math.random() * (Math.PI * 2)
        });
    }

    function draw() {
        context.clearRect(0, 0, W, H);
        context.fillStyle = "rgba(255, 255, 255, 1)";
        context.beginPath();
        for (var i = 0; i < particles.length; i++) {
            var p = particles[i];
            context.moveTo(p.x, p.y);
            context.arc(p.x, p.y, p.r, 0, Math.PI * 2, true);
        }
        context.fill();
        update();
    }

    var speed = 0;
    function update() {
        speed += 0.05;
        for (var i = 0; i < particles.length; i++) {
            var p = particles[i];
            p.y += speed * Math.cos(p.a) * p.d;//+ p.d + 1 + p.r / 2;

            p.x += speed * Math.sin(p.a) * p.d;// * 2;

            if (p.x > W || p.x < 0 || p.y > H || p.y < 0) {
                /*particles[i] = {
                 x: W / 2,
                 y: H / 2,
                 r: p.r,
                 d: p.d,
                 a: Math.random() * (Math.PI * 2)
                 };*/
                //particles.splice(i, 1); Causes performance issues
            };
        }
    }
    var intervalID = setInterval(draw, 33);
    $(window).resize(function () {
        W = $canvas.width();
        H = $canvas.height();
        //canvas.width = W;
        //canvas.height = H;
    });
});






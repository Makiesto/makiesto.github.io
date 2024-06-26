// CANVAS
const canvas = document.getElementById('animationCanvas');
const ctx = canvas.getContext('2d');

const circle = {
    x: 50,
    y: 50,
    radius: 20,
    dx: 2,
    dy: 2
};

function drawCircle() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.beginPath();
    ctx.arc(circle.x, circle.y, circle.radius, 0, Math.PI * 2, false);
    ctx.fillStyle = 'tomato';
    ctx.fill();
    ctx.closePath();
}

function updateCanvas() {
    drawCircle();

    if (circle.x + circle.radius > canvas.width || circle.x - circle.radius < 0) {
        circle.dx *= -1;
    }

    if (circle.y + circle.radius > canvas.height || circle.y - circle.radius < 0) {
        circle.dy *= -1;
    }

    circle.x += circle.dx;
    circle.y += circle.dy;

    requestAnimationFrame(updateCanvas);
}

canvas.addEventListener('click', function(e) {
    const rect = canvas.getBoundingClientRect();
    const mouseX = e.clientX - rect.left;
    const mouseY = e.clientY - rect.top;

    if (Math.sqrt((mouseX - circle.x) ** 2 + (mouseY - circle.y) ** 2) < circle.radius) {
        circle.dx *= -1;
        circle.dy *= -1;
    }
});

updateCanvas();
;
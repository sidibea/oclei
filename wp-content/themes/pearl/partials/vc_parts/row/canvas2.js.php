var raster = new Raster('image<?php echo esc_attr($uniq); ?>');
raster.position = view.center;
var circle;

initialize();

function initialize() {
    var width = view.size.width;
    var height = view.size.height;

    var radius = 3000;

    var circleCenter = new Point(width / 2, height - radius);

    circle = new Path.Circle({
        center: circleCenter,
        radius: radius
    });

    circle.clipMask = true;
}

// Lets animate the circle:
function onFrame(event) {
    var offset = Math.sin(event.count / 30) * 50;
//    circle.position.x = view.center.x + offset;
//    console.log(circle);
}
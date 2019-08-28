var width, height, center;
var points = 4;
var ellipse = new Path();

initializePath();


var raster = new Raster('image<?php echo esc_attr($uniq); ?>');
raster.fitBounds(view.bounds, true);

function initializePath() {
    center = view.center;
    width = view.size.width;
    height = view.size.height;

    var x1y1 = new paper.Point(- (width * 0.5 ), - (height * 0.2) );
    var x2y2 = new paper.Point(width * 1.5, height);
    ellipse = new paper.Path.Ellipse(x1y1, x2y2);

    ellipse.clipMask = true;

}

function onFrame(event) {
//    var offset = Math.sin(event.count / 30) * 30;
//    ellipse.position.y += offset;
}

// Reposition the ellipse whenever the window is resized:
function onResize(event) {
    initializePath();
}
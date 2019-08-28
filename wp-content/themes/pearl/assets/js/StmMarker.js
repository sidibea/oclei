'use strict';

var overlay;

function StmMarker(latlng, map, args) {
    overlay = new google.maps.OverlayView();
    overlay.latlng = latlng;
    overlay.args = args;
    overlay.setMap(map);

    overlay.draw = function () {

        var self = this;
        var div = this.div;
        var $ = jQuery;

        if (!div) {

            div = this.div = document.createElement('div');

            div.className = 'marker';

            div.style.position = 'absolute';
            div.style.cursor = 'pointer';
            if (typeof this.args.icon === 'undefined') {
                if (typeof this.args.html === 'undefined') {
                    div.style.width = '5px';
                    div.style.height = '5px';
                    div.style.background = 'blue';
                }
                jQuery(div).html(this.args.html);
            } else {
                var icon = this.icon = document.createElement('img');
                icon.src = this.args.icon;
            }

            if (typeof self.args.marker_id !== 'undefined') {
                div.dataset.marker_id = self.args.marker_id;
            }

            google.maps.event.addDomListener(div, "click", function (event) {
                google.maps.event.trigger(self, "click");
            });

            var panes = this.getPanes();
            if (typeof panes !== 'undefined') {
                overlay.markerDom = $(div).appendTo(panes.overlayMouseTarget);

                if (typeof this.icon !== 'undefined') {
                    overlay.markerDom.html(this.icon);
                }

                if (typeof this.args.content !== 'undefined') {
                    overlay.infoWindow(overlay.markerDom, this.args.content);
                }
                if (typeof this.args.created === 'function') {
                    this.args.created.call(overlay);
                }
            }
        }

        if (typeof this.getProjection() !== 'undefined') {
            var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
        }

        if (point) {
            div.style.left = point.x + 'px';
            div.style.top = point.y + 'px';
        }

        this.setPosition(overlay.markerDom);
    };

    overlay.remove = function () {
        var $ = jQuery;
        if (this.div) {
            $(this.div).remove();
            this.div = null;
        }
    };

    overlay.setPosition = function (marker) {

        var offset = ' transform:translate(-50%, -50%)';
        var styles = marker.attr('style') + offset;
        marker.attr('style', styles);
    };

    overlay.getPosition = function () {
        return this.latlng;
    };

    overlay.getDom = function () {
        google.maps.event.addDomListener(window, 'bounds_changed', function () {
            setTimeout(function () {
                return overlay.markerDom;
            }, 1000);
        });
    };

    overlay.infoWindow = function (el, content) {

        var iw = new StmInfoBox({
            content: content,
            maxWidth: 300,
            boxStyle: {
                height: '300px',
                background: 'red'
            }
        }, el);

        overlay.markerDom.hover(function () {
            iw.open();
        }, function () {
            iw.close();
        });
    };

    return overlay;
}
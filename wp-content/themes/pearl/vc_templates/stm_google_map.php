<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$map_classes = array();

$style = (empty($style)) ? 'style_1' : $style;


$disable_carousel = (!empty($disable_carousel) and $disable_carousel == 'disable') ? 'disable' : 'enable';

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$map_classes[] = $css_class;
$map_classes[] = $style;
$map_classes[] = 'carousel-' . $disable_carousel;
pearl_add_element_style('gmap', $style);

wp_enqueue_script('pearl-owl-carousel2');
wp_enqueue_style('owl-carousel2');
wp_enqueue_script('StmMarker.js');
wp_enqueue_script('gmap');

$owl_id = uniqid('owl_');
$owl_nav_id = uniqid('owl-nav-');

$gmap_id = uniqid('stm-gmap-');
$map_id = uniqid('map_');

$map_style = array();

if ($map_height) {
	$map_style['height'] = 'height: ' . $map_height . ';';
}

if ($disable_mouse_whell == 'disable') {
	$disable_mouse_whell = 'false';
} else {
	$disable_mouse_whell = 'true';
}


if (!empty($map_custom_style)) {
	/*Fix for themecheck*/
	$decode_styles = 'base64' . '_decode';
	$map_custom_style = "styles :" . rawurldecode($decode_styles(strip_tags($map_custom_style)));
}

$iw_wrapper_style = '.stm-iw-wrapper';


?>
<?php if (!empty($content)): ?>
    <div id="<?php echo esc_attr($map_id); ?>"
         class="stm_gmap_wrapper<?php echo esc_attr(implode(' ', $map_classes)); ?>"<?php echo(($map_style) ? ' style="' . esc_attr(implode(' ', $map_style)) . '"' : ''); ?>>
        <div<?php echo(($map_style) ? ' style="' . esc_attr(implode(' ', $map_style)) . '"' : ''); ?>
                id="<?php echo esc_attr($gmap_id); ?>" class="stm_gmap"></div>
        <div class="gmap_addresses">
			<?php if ($disable_carousel == 'disable'): ?>
                <div class="addresses_wr">
                    <div class="addresses" id="<?php echo esc_attr($owl_id); ?>">
						<?php echo wpb_js_remove_wpautop($content); ?>
                    </div>
                </div>
			<?php else: ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="addresses_wr">
                                <div class="addresses" id="<?php echo esc_attr($owl_id); ?>">
									<?php echo wpb_js_remove_wpautop($content); ?>
                                </div>
                            </div>
                        </div>
                        <div class="owl-dots-wr">
                            <div class="owl-dots" id="<?php echo esc_attr($owl_nav_id); ?>"></div>
                        </div>
                    </div>
                </div>
			<?php endif; ?>
        </div>
    </div>


    <!--Get script-->
	<?php ob_start(); ?>
    <script type="text/javascript">
        (function ($) {
            document.body.addEventListener("stm_gmap_api_loaded", stm_init_map, false);
            function stm_init_map() {
                var default_marker_icon;
                var <?php echo esc_js($map_id); ?>;
                var markers = [];
                var gmarkers = [];
                var <?php echo esc_js($owl_id); ?> =
                $("#<?php echo esc_js($owl_id); ?>");


				<?php if (!$marker) {
				$pin_color = pearl_get_option('main_color'); ?>
                var svg = '<?php echo base64_encode("<svg width=\"60\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"-56 -12.5 86.5 86.5\" enable-background=\"new -56 -12.5 86.5 86.5\" xml:space=\"preserve\"><circle fill='". $pin_color ."' cx=\"-12.8\" cy=\"30.8\" r=\"43.3\"/><path fill=\"#FFFFFF\" d=\"M-2.5,16.3c-2.6-2.6-6-4-9.6-4c-3.6,0-7.1,1.4-9.6,4c-4.8,4.8-5.4,13.9-1.3,19.3l10.9,15.9l10.9-15.9C2.9,30.2,2.3,21.2-2.5,16.3z M-12,31c-2.7,0-5-2.3-5-5c0-2.8,2.2-5,5-5c2.7,0,5,2.3,5,5C-7,28.7-9.3,31-12,31z\"/></svg>") ?>';
                default_marker_icon = 'data:image/svg+xml;base64, ' + svg;
				<?php } else {
				$marker_url = (empty($img_size)) ? wp_get_attachment_image_url($marker, 'full') : pearl_get_VC_attachment_img_safe($marker, $img_size, 'full', true);
				?>

                default_marker_icon = '<?php echo esc_url($marker_url); ?>';
				<?php } ?>

                var mapId = '<?php echo esc_js($gmap_id); ?>';
                var mapOptions = {
                    zoom: <?php echo esc_js($map_zoom); ?>,
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.LEFT_TOP
                    },
                    streetViewControl: false,
                    scrollwheel: <?php echo esc_js($disable_mouse_whell); ?>,
					<?php echo sanitize_text_field($map_custom_style); ?>
                };
                var $mapElement = $('body').find('#<?php echo esc_js($gmap_id); ?>');
                var mapElement = $mapElement[0];

                if (mapElement == null) return;
                if ($mapElement.html() !== '') return;
				<?php echo esc_js($map_id); ?> = new google.maps.Map(mapElement, mapOptions);
                var owlId = <?php echo esc_js($owl_id); ?>;
                var owlData = null;
                var inited = false;


                owlId.owlCarousel({
                    dotsContainer: '#<?php echo esc_js($owl_nav_id); ?>',
                    items: <?php echo esc_js($images_qty) ?>,
                    margin: 50,
                    loop: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        550: {
                            items: <?php echo (intval($images_qty) > 1) ? 2 : intval($images_qty); ?>
                        },
                        980: {
                            items: <?php echo esc_js($images_qty) ?>
                        },
                        1199: {
                            items: <?php echo esc_js($images_qty) ?>
                        }
                    },
                    onTranslated: function () {
                        pearl_setMarkers();
                        $('.gmap_addresses .owl-item.active').last().addClass('last-active');
                    },
                    onDragged: function () {
                    },
                    onTranslate: function () {
                        $('.owl-item').removeClass('last-active');
                    },
                    onInitialized: function () {
                        $('.gmap_addresses .owl-item.active').last().addClass('last-active');
                        pearl_setMarkers();
                    }
                });

                owlData = owlId.data('owlCarousel');


                function pearl_setMarkers() {
                    var owlId = <?php echo esc_js($owl_id); ?>;
                    var latlngbounds = new google.maps.LatLngBounds();
                    var map = <?php echo esc_js($map_id); ?>;


                    markers = [];
                    owlId.find('.owl-item.active').each(function (i) {
                        markers.push([parseFloat($(this).find('.item').data('lat')), parseFloat($(this).find('.item').data('lng')), $(this).find('.item').data('title')]);
                    });
                    for (i = 0; i < gmarkers.length; i++) {
                        gmarkers[i].setMap(null);
                    }

                    for (var i = 0; i < markers.length; i++) {
                        var marker_array = markers[i];
                        var latlng = new google.maps.LatLng(marker_array[0], marker_array[1]);

                        var marker = new StmMarker(
                            latlng,
                            map,
                            {
                                title: marker_array[2],
                                marker_id: 'marker_' + i,
                                icon: default_marker_icon,
                                content: marker_array[2],
                                created: function () {

                                    var markerDom = this.markerDom;
                                    if (typeof  markerDom === 'undefined') return;
                                    console.log(markerDom);

                                    if (default_marker_icon.indexOf('data:image/svg+xml;base64') >= 0) {
                                        markerDom.find('img').attr('width', 75);
                                    }

                                    var higlighted = owlId.find('.owl-item.active').eq(markerDom.index());

                                    this.markerDom.hover(
                                        function () {
                                            higlighted.addClass('highlighted');
                                            higlighted.find('.icon').addClass('stc');
                                        },
                                        function () {
                                            higlighted.removeClass('highlighted');
                                            higlighted.find('.icon').removeClass('stc');

                                        }
                                    )
                                }
                            }
                        );
                        latlngbounds.extend(new google.maps.LatLng(marker_array[0], marker_array[1]));
                        gmarkers.push(marker);

                    }
                    map.fitBounds(latlngbounds);

                    if (markers.length === 1) {
                        var listener = google.maps.event.addListener(map, "idle", function () {
							<?php echo esc_js($map_id); ?>.
                            setZoom(<?php echo esc_js($map_zoom); ?>);
                            google.maps.event.removeListener(listener);
                        });
                    }

                    google.maps.event.addListenerOnce(<?php echo esc_js($map_id); ?>, 'bounds_changed', function () {
                        offsetCenter(latlngbounds.getCenter(), 0, $("#<?php echo esc_js($map_id); ?> .gmap_addresses").innerHeight());


                        if (/Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
							<?php echo esc_js($map_id); ?>.
                            setZoom(<?php echo esc_js($map_id); ?>.getZoom() - 4
                        )
                            ;
                        } else {
							<?php echo esc_js($map_id); ?>.
                            setZoom(<?php echo esc_js($map_id); ?>.getZoom() - 1
                        );}
                    });


                }


                function offsetCenter(latlng, offsetx, offsety) {

                    var map = <?php echo esc_js($map_id); ?>;

                    var scale = Math.pow(2, map.getZoom());
                    var nw = new google.maps.LatLng(
                        map.getBounds().getNorthEast().lat(),
                        map.getBounds().getSouthWest().lng()
                    );
                    var worldCoordinateCenter = map.getProjection().fromLatLngToPoint(latlng);
                    var pixelOffset = new google.maps.Point((offsetx / scale) || 0, (offsety / scale) || 0)

                    var worldCoordinateNewCenter = new google.maps.Point(
                        worldCoordinateCenter.x - pixelOffset.x,
                        worldCoordinateCenter.y + pixelOffset.y
                    );

                    var newCenter = map.getProjection().fromPointToLatLng(worldCoordinateNewCenter);

                    map.setCenter(newCenter);

                }
            }
        })(jQuery);
    </script>
	<?php
	$custom_js_script = ob_get_clean();
	$custom_js = str_replace(array('<script type="text/javascript">', '</script>'), '', $custom_js_script);
	wp_add_inline_script('StmMarker.js', $custom_js);


	/*Fix map for barba*/
	if (!empty($_SERVER['HTTP_X_BARBA']) && $_SERVER['HTTP_X_BARBA'] === 'yes') {
		ob_start();
		require_once(locate_template("assets/js/StmMarker.js"));
		$custom_js_script = str_replace('<script type="text/javascript">', '<script type="text/javascript">' . ob_get_clean() . ' ', $custom_js_script);

		$js = array('document.body.addEventListener("stm_gmap_api_loaded", stm_init_map, false);', 'function stm_init_map');
		$js_code = array('', 'window.stm_init_map_barba = function');

		echo html_entity_decode(str_replace($js, $js_code, $custom_js_script));
	}
	?>

<?php endif; ?>
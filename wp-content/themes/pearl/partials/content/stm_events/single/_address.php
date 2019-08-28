<?php
$tpl = 'partials/content/stm_events/single/';

$id = get_the_ID();
$lat = get_post_meta($id, 'latitude', true);
$lng = get_post_meta($id, 'longitude', true);

$include_map = '';
if(!empty($lat) and !empty($lng)) $include_map = 'included'; ?>

<div class="stm_mgb_40 stm_single_event__address stm_single_event_map_<?php echo esc_attr($include_map); ?>">

    <?php if(!empty($include_map)):
        wp_enqueue_script('gmap');
        $url = get_template_directory_uri() . '/assets/img/markers/';
        ?>
        <div id="gmap"></div>
        <script>
            (function($){
                document.body.addEventListener("stm_gmap_api_loaded", initMap, false);

                var map = latlng = '';
                function initMap(e) {
                    var lat = <?php echo esc_js($lat); ?>;
                    var lng = <?php echo esc_js($lng); ?>;
                    latlng = new google.maps.LatLng(lat, lng);


                    <?php $pin_color = pearl_get_option('main_color'); ?>
                    var default_marker_icon = 'data:image/svg+xml;utf-8, <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="86.5" height="86.5" viewBox="0 0 86.5 86.5">\n' +
                        '  <defs>\n' +
                        '    <style>\n' +
                        '      .cls-1 {\n' +
                        '        fill: <?php echo esc_attr($pin_color); ?>;\n' +
                        '      }\n' +
                        '\n' +
                        '      .cls-2 {\n' +
                        '        fill: #fff;\n' +
                        '        fill-rule: evenodd;\n' +
                        '      }\n' +
                        '    </style>\n' +
                        '  </defs>\n' +
                        '  <g>\n' +
                        '    <circle cx="43.25" cy="43.25" r="43.25" class="cls-1"/>\n' +
                        '    <path d="M53.501,28.844 C50.924,26.245 47.498,24.814 43.855,24.814 C40.210,24.814 36.785,26.245 34.208,28.844 C29.440,33.654 28.847,42.702 32.925,48.184 L43.855,64.105 L54.768,48.206 C58.862,42.702 58.269,33.654 53.501,28.844 ZM43.980,43.470 C41.235,43.470 39.001,41.216 39.001,38.447 C39.001,35.678 41.235,33.424 43.980,33.424 C46.726,33.424 48.960,35.678 48.960,38.447 C48.960,41.216 46.726,43.470 43.980,43.470 Z" class="cls-2"/>\n' +
                        '  </g>\n' +
                        '</svg>';

                    //var markerImage = '<?php echo esc_url($url . 'marker_1.svg') ?>';

                    var place = {lat: lat, lng: lng};

                    map = new google.maps.Map(document.getElementById('gmap'), {
                        zoom: 16,
                        scrollwheel: false,
                        center: place
                    });

                    var marker = new google.maps.Marker({
                        position: place,
                        map: map,
                        icon: default_marker_icon,
                    });

                    var $info = $('.stm_single_event__overlay');
                    var wWidth = $(document).width();
                    if($info.length && wWidth > 440) {
                        google.maps.event.addListenerOnce(map, "projection_changed", function() {
                            stmOffsetCenter(map, latlng, '-' + ($info.width()/2), -30);
                        });
                    }
                }

            })(jQuery);
        </script>
    <?php endif; ?>

    <?php get_template_part($tpl . '_address_info'); ?>

</div>
<!--Site global modals-->
<?php
$modals = array(
	'_search',
	'_album'
);

foreach ($modals as $modal) {
	get_template_part('partials/modals/' . $modal);
}
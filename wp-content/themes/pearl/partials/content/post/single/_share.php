<?php
if (function_exists('sharethis_inline_buttons')) {
	echo sharethis_inline_buttons();
} else {
	if(function_exists('stm_get_shares')) {
		stm_get_shares();
	}
};
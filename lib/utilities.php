<?php

/*
 * TSA Commerce Get Path
 * return: /wordpress/wp-content/plugins/tsa-commerce/
 */
if(!function_exists('tsac_get_path')) {
	function tsac_get_path() {
		return plugin_dir_path( dirname(__FILE__) );
	}
}


/*
 * TSA Commerce Get URI
 * return: http://our.domain/wp-content/plugins/tsa-commerce
 */
if(!function_exists('tsac_get_uri')) {
	function tsac_get_uri() {
		return plugins_url() . '/tsa-commerce';
	}
}

<?php
/**
* Plugin Name: TSA Commerce
* Plugin URI: https://tsacommerce.com
* Description: Convierte tu Wordpress en un "Turbo SEO Affiliate Commerce". Fácil, sencillo y ligero.
* Version: 1.0.2
* Author: Samuel Rocha y Pablo Rocha
* Author URI: https://tsacommerce.com
* Text Domain: tsa-commerce
* Domain Path: /languages
* License: GPL2
*/

require_once('lib/utilities.php');

$tsa_includes = array(
    'lib/functions.php',        // Custom functions
    'lib/vendors.php',          // Vendors (acf)
    'lib/cpt.php',              // Custom Post Type
    'lib/custom-fields.php',    // Custom Fields
    'lib/options-page.php',     // Options page
    'lib/shortcode.php',        // Shortcodes
    'lib/assets.php',           // Assets
    'lib/yoast.php'             // Yoast SEO
);

foreach ($tsa_includes as $file) {
    $filepath = tsac_get_path() . '/' . $file;

    require_once $filepath;
}

unset($file, $filepath);

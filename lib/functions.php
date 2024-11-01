<?php

load_textdomain('tsa-commerce', tsac_get_path() . 'languages/tsa-commerce-' . get_locale() . '.mo');

add_action( 'plugins_loaded', 'tsac_load_textdomain' );
function tsac_load_textdomain() {
    load_plugin_textdomain( 'tsa-commerce', false, 'tsa-commerce/languages/' );
}

function tsac_grid_class($columns = '3', $grid = 'bootstrap') {

    $grid_system = array(
        'tsa'        => array(
            'row' => 'cf',
            '1'   => 'm-all d-all',
            '2'   => 'm-all d-1of2',
            '3'   => 'm-all d-1of3',
            '4'   => 'm-all d-1of4',
        ),
        'bootstrap'  => array(
            'row' => 'row',
            '1'   => 'col-xs-12',
            '2'   => 'col-xs-12 col-sm-6',
            '3'   => 'col-xs-12 col-sm-4',
            '4'   => 'col-xs-12 col-sm-3',
        ),
        'foundation' => array(
            'row' => 'row',
            '1'   => 'small-12 large-12 columns',
            '2'   => 'small-12 large-6 columns',
            '3'   => 'small-12 large-4 columns',
            '4'   => 'small-12 large-3 columns',
        ),
    );

    return $grid_system[$grid][$columns];

}

function tsac_generate_url_old($url) {

    $options_options = get_option( 'options_option_name' );
    $amazon_associates_id = $options_options['tsa_amazon_associates_id'];

    $posQ = strpos($url, '?');
    $posT = strpos($url, 'tag=');

    if( $posQ === false ) {
        $url .= '?tag=' . $amazon_associates_id;
    } else {
        if( $posT === false ) {
            $url .= '&tag=' . $amazon_associates_id;
        } else {

            $url = substr($url, 0, $posT-1) . '&tag=' . $amazon_associates_id . ( ( strpos($url, '&', $posT) == false ) ? '' : substr($url, strpos($url, '&', $posT)) );
        }
    }

    return $url;

}

// http://stackoverflow.com/questions/15783116/php-preg-replace-expression-to-remove-url-parameter
function tsac_generate_url($url) {

    // Fix url encode
    // $url = str_replace('&amp;', '', $url);
    $url = htmlspecialchars_decode($url);

    $options_options = get_option( 'options_option_name' );
    $amazon_associates_id = $options_options['tsa_amazon_associates_id'];

    list($file, $parameters) = explode('?', $url);
    parse_str($parameters, $output);
    unset($output['tag']); // remove the make parameter

    $result = $file . '?' . http_build_query($output) . ( ( strlen(http_build_query($output)) > 0 ) ? '&' : '' ) . 'tag=' . $amazon_associates_id; // Rebuild the url

    return $result;
}

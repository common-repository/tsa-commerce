<?php

/*
 * [tsa_products category="" columns="" grid=""]
 * Muestra una lista de productos a modo de grilla de una categoría seleccionada
 * y número de columnas y estilo (bootstrap, foundation)
 */

function tsac_shortcode_products( $atts , $content = null ) {

    // Attributes
    $atts = shortcode_atts(
        array(
            'category'=> '',
            'columns' => '3',
            'grid'    => 'bootstrap',
            'posts'   => '-1',
            'orderby' => 'date',
            'order'   => 'DESC',
        ),
        $atts,
        'tsa_products'
    );

    // WP_Query arguments
    $args = array(
        'post_type'              => array( 'tsa_product' ),
        'post_status'            => array( 'publish' ),
        'posts_per_page'         => $atts['posts'],
        'order'                  => $atts['order'],
        'orderby'                => $atts['orderby'],
        'tax_query' => array(
            array(
                'taxonomy' => 'tsa_product_category',
                'field'    => 'slug',
                'terms'    => $atts['category'],
            ),
        ),
    );

    // Query
    $query = new WP_Query( $args );
    $key = 1;

    // Loop
    if ( $query->have_posts() ) {

        $options_options = get_option( 'options_option_name' );
        $tsa_show_price = $options_options['tsa_show_price'];

        $output = '<div class="' . tsac_grid_class('row',$atts['grid']) . '">';
        while ( $query->have_posts() ) {
            $query->the_post();
            // do something

            $fields = get_fields();
            $fields['title'] = get_the_title();

            $output .= '<a class="tsa-card ' . tsac_grid_class($atts['columns'],$atts['grid']) . '" href="' . tsac_generate_url($fields['tsa_product_url']) . '" rel="nofollow" target="_blank" title="' . $fields['title'] . '">';
            $output .= '    <figure class="tsa-card__figure">';
            $output .= '        <img class="tsa-card__image" src="' . $fields['tsa_product_image_url'] . '">';
            $output .= '    </figure>';
            $output .= '    <h3 class="tsa-card__title' . (($fields['tsa_product_show_price'] == 1 && $tsa_show_price == 1) ? ' tsa-card__title--price' : '') . '">' . $fields['title'] . '</h3>';
            if( $fields['tsa_product_show_price'] == 1 && $tsa_show_price == 1 && $fields['tsa_product_current_price'] != '' ) {
            $output .= '    <span class="tsa-card__price">' . $fields['tsa_product_current_price'] . '</span>';
            $output .= '    <span class="tsa-button">' . __( 'View product', 'tsa-commerce' ) . '</span>';
            } else {
            $output .= '    <span class="tsa-button">' . __( 'View price', 'tsa-commerce' ) . '</span>';
            }
            $output .= '</a>';

            if ( $key % $atts['columns'] == 0 ) {
                $output .= '</div>';
                $output .= '<div class="' . tsac_grid_class('row',$atts['grid']) . '">';
            }

            $key++;
        }
        $output .= '</div>';
    } else {
        // no posts found
    }

    // Reset post data
    wp_reset_postdata();

    // Return code
    return $output;

}
add_shortcode( 'tsa_products', 'tsac_shortcode_products' );



/*
 * [tsa_categories columns="" grid=""]
 * Muestra la lista de categorias a modo de grilla con el número de columnas
 * seleccionadas y estilo (bootstrap, foundation)
 */

function tsac_shortcode_categories( $atts , $content = null ) {

    // Attributes
    $atts = shortcode_atts(
        array(
            'columns' => '3',
            'grid'    => 'bootstrap',
            'orderby' => 'name',
            'order'   => 'ASC',
            'hide_empty' => 1,
        ),
        $atts,
        'tsa_categories'
    );

    $categories = get_categories(array(
        'orderby' => $atts['orderby'],
        'order'   => $atts['order'],
        'hide_empty' => $atts['hide_empty'],
        'taxonomy' => 'tsa_product_category'
    ));

    $output = '<div class="' . tsac_grid_class('row',$atts['grid']) . '">';

    foreach ($categories as $key => $category) {
        $fields = get_fields($category);

        if( !empty($fields['tsa_category_page_link']) ) {


            $output .= '<a class="tsa-card tsa-card--category ' . tsac_grid_class($atts['columns'],$atts['grid']) . '" href="' . $fields['tsa_category_page_link'] . '" rel="nofollow" title="' . $category->name . '">';
            $output .= '   <figure class="tsa-card__figure">';
            $output .= '       <img class="tsa-card__image" src="' . $fields['tsa_category_image']['url'] . '">';
            $output .= '   </figure>';
            $output .= '   <h3 class="tsa-card__title">' . $category->name . '</h3>';
            $output .= '   <span class="tsa-button">' . __( 'View products', 'tsa-commerce' ) . '</span>';
            $output .= '</a>';

            $key++;
            if ( $key % $atts['columns'] == 0 ) {
                $output .= '</div>';
                $output .= '<div class="' . tsac_grid_class('row',$atts['grid']) . '">';
            }

        }
    }

    $output .= '</div>';

    // Return code
    return $output;

}
add_shortcode( 'tsa_categories', 'tsac_shortcode_categories' );




/*
 * [tsa_related_categories categories="term1,term2,term3..." columns="" grid=""]
 * Muestra una lista de categorias "relacionadas" a modo de grilla de una
 * categoría seleccionada y estilo (bootstrap, foundation)
 */

function tsac_shortcode_related_categories( $atts , $content = null ) {

    // Attributes
    $atts = shortcode_atts(
        array(
            'categories' => '',
            'columns' => '3',
            'grid' => 'bootstrap',
        ),
        $atts,
        'tsa_related_categories'
    );

    $categories_slug = explode(',', $atts['categories']);

    $output = '<div class="' . tsac_grid_class('row',$atts['grid']) . '">';

    foreach ($categories_slug as $key => $slug) {
        // http://stackoverflow.com/questions/2109325/how-to-strip-all-spaces-out-of-a-string-in-php
        $slug = preg_replace('/\s+/', '', $slug);
        $category = get_term_by( 'slug', $slug, 'tsa_product_category' );
        $fields   = get_fields($category);

        if( !empty($fields['tsa_category_page_link']) ) {

            $output .= '<a class="tsa-card ' . tsac_grid_class($atts['columns'],$atts['grid']) . '" href="' . $fields['tsa_category_page_link'] . '" rel="nofollow" title="' . $category->name . '">';
            $output .= '    <figure class="tsa-card__figure">';
            $output .= '        <img class="tsa-card__image" src="' . $fields['tsa_category_image']['url'] . '">';
            $output .= '    </figure>';
            $output .= '    <h3 class="tsa-card__title">' . $category->name . '</h3>';
            $output .= '    <span class="tsa-button">' . __( 'View products', 'tsa-commerce' ) . '</span>';
            $output .= '</a>';

            $key++;
            if ( $key % $atts['columns'] == 0 ) {
                $output .= '</div>';
                $output .= '<div class="' . tsac_grid_class('row',$atts['grid']) . '">';
            }

        }
    }

    $output .= '</div>';

    // Return code
    return $output;

}
add_shortcode( 'tsa_related_categories', 'tsac_shortcode_related_categories' );

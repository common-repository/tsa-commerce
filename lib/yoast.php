<?php

// https://kb.yoast.com/kb/how-to-customize-the-sitemap-index/

/* Exclude Post Type From Yoast SEO Sitemap */
function tsac_sitemap_exclude_cpt_product( $value, $post_type ) {
    if ( $post_type == 'tsa_product' ) return true;
}
add_filter( 'wpseo_sitemap_exclude_post_type', 'tsac_sitemap_exclude_cpt_product', 10, 2 );


/* Exclude Taxonomy From Yoast SEO Sitemap */
function tsac_sitemap_exclude_taxonomy_product( $value, $taxonomy ) {
    if ( $taxonomy == 'tsa_product_category' ) return true;
}
add_filter( 'wpseo_sitemap_exclude_taxonomy', 'tsac_sitemap_exclude_taxonomy_product', 10, 2 );

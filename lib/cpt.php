<?php

// Register Custom Post Type
function tsac_cpt_product() {

    $labels = array(
        'name'                  => __( 'Products', 'tsa-commerce' ),
        'singular_name'         => __( 'Product', 'tsa-commerce' ),
        'menu_name'             => _x( 'TSA Commerce', 'tsa-commerce' ),
        'name_admin_bar'        => __( 'Product', 'tsa-commerce' ),
        'archives'              => __( 'Product Archives', 'tsa-commerce' ),
        'attributes'            => __( 'Product Attributes', 'tsa-commerce' ),
        'parent_item_colon'     => __( 'Parent Product:', 'tsa-commerce' ),
        'all_items'             => __( 'All Products', 'tsa-commerce' ),
        'add_new_item'          => __( 'Add New Product', 'tsa-commerce' ),
        'add_new'               => __( 'Add New', 'tsa-commerce' ),
        'new_item'              => __( 'New Product', 'tsa-commerce' ),
        'edit_item'             => __( 'Edit Product', 'tsa-commerce' ),
        'update_item'           => __( 'Update Product', 'tsa-commerce' ),
        'view_item'             => __( 'View Product', 'tsa-commerce' ),
        'view_items'            => __( 'View Products', 'tsa-commerce' ),
        'search_items'          => __( 'Search Product', 'tsa-commerce' ),
        'not_found'             => __( 'Not found', 'tsa-commerce' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'tsa-commerce' ),
        'featured_image'        => __( 'Featured Image', 'tsa-commerce' ),
        'set_featured_image'    => __( 'Set featured image', 'tsa-commerce' ),
        'remove_featured_image' => __( 'Remove featured image', 'tsa-commerce' ),
        'use_featured_image'    => __( 'Use as featured image', 'tsa-commerce' ),
        'insert_into_item'      => __( 'Insert into product', 'tsa-commerce' ),
        'uploaded_to_this_item' => __( 'Uploaded to this product', 'tsa-commerce' ),
        'items_list'            => __( 'Products list', 'tsa-commerce' ),
        'items_list_navigation' => __( 'Products list navigation', 'tsa-commerce' ),
        'filter_items_list'     => __( 'Filter products list', 'tsa-commerce' ),
    );
    $args = array(
        'label'                 => __( 'Product', 'tsa-commerce' ),
        'description'           => __( 'TSA Commerce Product', 'tsa-commerce' ),
        'labels'                => $labels,
        'supports'              => array( 'title', ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-performance',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => false,
        'capability_type'       => 'post',
    );
    register_post_type( 'tsa_product', $args );

}
add_action( 'init', 'tsac_cpt_product', 0 );

// Register Custom Taxonomy
function tsac_taxonomy_product() {

    $labels = array(
        'name'                       => __( 'Categories', 'tsa-commerce' ),
        'singular_name'              => __( 'Category', 'tsa-commerce' ),
        'menu_name'                  => __( 'Categories', 'tsa-commerce' ),
        'all_items'                  => __( 'All Categories', 'tsa-commerce' ),
        'parent_item'                => __( 'Parent Category', 'tsa-commerce' ),
        'parent_item_colon'          => __( 'Parent Category:', 'tsa-commerce' ),
        'new_item_name'              => __( 'New Category Name', 'tsa-commerce' ),
        'add_new_item'               => __( 'Add New Category', 'tsa-commerce' ),
        'edit_item'                  => __( 'Edit Category', 'tsa-commerce' ),
        'update_item'                => __( 'Update Category', 'tsa-commerce' ),
        'view_item'                  => __( 'View Category', 'tsa-commerce' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'tsa-commerce' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'tsa-commerce' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'tsa-commerce' ),
        'popular_items'              => __( 'Popular Categories', 'tsa-commerce' ),
        'search_items'               => __( 'Search Categories', 'tsa-commerce' ),
        'not_found'                  => __( 'Not Found', 'tsa-commerce' ),
        'no_terms'                   => __( 'No categories', 'tsa-commerce' ),
        'items_list'                 => __( 'Categories list', 'tsa-commerce' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'tsa-commerce' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => false,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => false,
    );
    register_taxonomy( 'tsa_product_category', array( 'tsa_product' ), $args );

}
add_action( 'init', 'tsac_taxonomy_product', 0 );

<?php

if(function_exists("register_field_group")) {

    register_field_group(array (
        'id' => 'acf_affiliate-product',
        'title' => __( 'Affiliate product', 'tsa-commerce' ),
        'fields' => array (
            array (
                'key' => 'field_58eca0e092409',
                'label' => __( 'Product URL', 'tsa-commerce' ),
                'name' => 'tsa_product_url',
                'type' => 'text',
                'instructions' => __( 'Enter the product URL.', 'tsa-commerce' ),
                'required' => 1,
                'default_value' => '',
                'placeholder' => __( 'E.g. http://www.amazon.com/dp/XXXXXXXXXX/', 'tsa-commerce' ),
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_58eca29f9240b',
                'label' => __( 'Show price', 'tsa-commerce' ),
                'name' => 'tsa_product_show_price',
                'type' => 'true_false',
                'instructions' => __( 'Mark if you prefer to show the price of the product or not, by default Check.

Check: The price of the product and a "Buy" button will be displayed.
No check: A "See price" button will be displayed', 'tsa-commerce' ),
                'message' => __( 'Show price?', 'tsa-commerce' ),
                'default_value' => 1,
            ),
            array (
                'key' => 'field_58eca1e09240a',
                'label' => __( 'Current price', 'tsa-commerce' ),
                'name' => 'tsa_product_current_price',
                'type' => 'text',
                'instructions' => __( 'Enter the current price of the product.', 'tsa-commerce' ),
                'required' => 1,
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_58eca29f9240b',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'placeholder' => __( 'E.g. $19.92', 'tsa-commerce' ),
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_58eca3769240c',
                'label' => __( 'Image URL', 'tsa-commerce' ),
                'name' => 'tsa_product_image_url',
                'type' => 'text',
                'instructions' => __( 'Enter the URL of the product image.', 'tsa-commerce' ),
                'required' => 1,
                'default_value' => '',
                'placeholder' => __( 'E.g. https://images-na.ssl-images-amazon.com/images/I/61aN%2BSE-F9L.jpg', 'tsa-commerce' ),
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'tsa_product',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'acf_after_title',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array (
        'id' => 'acf_affiliate-product-category',
        'title' => 'Affiliate product category',
        'fields' => array (
            array (
                'key' => 'field_58eca5e33d398',
                'label' => __( 'Image', 'tsa-commerce' ),
                'name' => 'tsa_category_image',
                'type' => 'image',
                'instructions' => __( 'Select an image that represents your category.', 'tsa-commerce' ),
                'save_format' => 'object',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_58f3de316c041',
                'label' => __( 'Category page', 'tsa-commerce' ),
                'name' => 'tsa_category_page_link',
                'type' => 'page_link',
                'instructions' => __( 'Select the page to link your category to.', 'tsa-commerce' ),
                'post_type' => array (
                    0 => 'page',
                ),
                'allow_null' => 1,
                'multiple' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'ef_taxonomy',
                    'operator' => '==',
                    'value' => 'tsa_product_category',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}

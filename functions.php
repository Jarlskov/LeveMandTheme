<?php

add_action('wp_enqueue_scripts', 'levemand_enqueue_stuff');
add_action('init', 'levemand_create_post_types');
add_action('pre_get_posts', 'levemand_show_custom_post_types_on_frontpage');

add_filter( 'excerpt_length', 'levemand_excerpt_length', 999 );

function levemand_excerpt_length( $length ) {
    return 200;
}

function levemand_show_custom_post_types_on_frontpage($query) {
    if (is_home() && $query->is_main_query()) {
        $included_post_types = array(
            'post',
            'beer',
            'brewery',
            'beertype',
        );
        $query->set('post_type', $included_post_types);
    }
}

function levemand_create_post_types() {
    _levemand_create_post_type_beer();
    _levemand_create_post_type_brewery();
    _levemand_create_post_type_beer_type();
}

function _levemand_create_post_type_beer_type() {
    register_post_type('beertype',
        array(
            'labels' => array(
                'name' => __('Beer types'),
                'singular_name' => __('Beer type'),
            ),
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'comments',
                'revisions',
                'custom-fields',
            ),
            'description' => __('Beer type reviews and descriptions'),
            'has_archive' => true,
            'menu_position' => 6,
            'public' => true,
            'rewrite' => array('slug' => 'beertype'),
        )
    );
}

function _levemand_create_post_type_brewery() {
    register_post_type('brewery',
        array(
            'labels' => array(
                'name' => __('Breweries'),
                'singular_name' => __('Brewery'),
            ),
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'comments',
                'revisions',
                'custom-fields',
            ),
            'description' => __('Brewery reviews and descriptions'),
            'has_archive' => true,
            'menu_position' => 5,
            'public' => true,
            'rewrite' => array('slug' => 'brewery'),
        )
    );
}

function _levemand_create_post_type_beer() {
    register_post_type('beer',
        array(
            'labels' => array(
                'name' => __('Beer'),
                'singular_name' => __('Beer'),
            ),
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'comments',
                'revisions',
                'custom-fields',
            ),
            'description' => __('Beer reviews and descriptions'),
            'has_archive' => true,
            'menu_position' => 4,
            'public' => true,
            'rewrite' => array('slug' => 'beer'),
        )
    );
}

function levemand_enqueue_stuff() {
    wp_enqueue_style('toivo-lite', get_template_directory_uri() . '/style.css');
    wp_enqueue_script('levemand-script', get_stylesheet_directory_uri() . '/script.js', array('jquery'), '1', TRUE);
}

add_filter( 'mc4wp_form_css_classes', function( $classes ) { 
    $classes[] = 'post-bottom-form';
    return $classes;
});

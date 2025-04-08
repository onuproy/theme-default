<?php
/**
 * Custom block category
 */
function coderitem_blocks_plugin_block_categories( $categories ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'coderitem',
                'title' => __( 'Coder Item', 'coderlang' ),
                'icon'  => 'wordpress',
            ),
        )
    );
}
add_filter( 'block_categories', 'coderitem_blocks_plugin_block_categories', 10, 2 );

//acf blocks
function register_acf_block_types() {
    // register a header_banner block.
    acf_register_block_type(array(
        'name'              => 'header_banner',
        'title'             => __('Header Banner'),
        'description'       => __('This is the Header Banner of Home page'),
        'render_template'   => 'inc/acf-coder/blocks/header-banner/hader-banner.php',
        'category'          => 'coderitem',
        'icon'              => 'editor-paste-text',
        'keywords'          => array( 'header banner', 'banner','Home Banner'),
    ));
    //Add more block here

}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}
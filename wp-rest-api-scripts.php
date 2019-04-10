<?php
/**
 * @package Hello_Dolly
 * @version 1.7
 */
/*
Plugin Name: WP REST API Scripts
Plugin URI: http://wordpress.org/plugins/wp-rest-api-scripts
Description: Adds scripts to REST API responses.
Author: Mike Nelson
Version: 1.0
*/
function wp_rest_api_scripts_add_field()
{
    register_rest_field(
        array(
            'post',
            'page'
        ),
        'scripts',
        array(
            'get_callback' => 'wp_rest_api_scripts_get_field',
            'schema' => array(
                'type' => 'string',
                'context' => array(
                    'view',
                    'edit'
                )
            )
        )
    );
}

add_action('rest_api_init', 'wp_rest_api_scripts_add_field');
function wp_rest_api_scripts_get_field($post, $field_name, $request)
{
//    global $wp_scripts;
//    $results = wp_print_scripts();
    ob_start();
//    do_action('wp_print_scripts');

    print_head_scripts();
    _wp_footer_scripts();
    $results = ob_get_clean();
    return $results;
}
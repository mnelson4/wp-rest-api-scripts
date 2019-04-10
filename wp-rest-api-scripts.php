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
/**
 * Gets the enqueued scripts and stylesheets that would normally go into the header and footer, and instead dumps them
 * into this field. Yes, it's that easy (it turns out web browsers are pretty good at sorting out the mess.)
 * @since $VID:$
 * @param $post
 * @param $field_name
 * @param $request
 * @return false|string
 */
function wp_rest_api_scripts_get_field($post, $field_name, $request)
{
    ob_start();
    print_head_scripts();
    _wp_footer_scripts();
    $results = ob_get_clean();
    return $results;
}
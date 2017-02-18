<?php
/**
 * Plugin Name: Band Names
 * Plugin URI: http://russellenvy.com
 * Description: Simply create a post type called band names and display band names with a shortcode.
 * Version: 1.0.0
 * Author: Russell Aaron
 * Author URI: http://russellenvy.com
 * Text Domain: band_names
 * License: GPL2
 */
 function band_names_post_type() {
  $labels = array(
    'name' => 'Band Names',
    'singular_name' => 'Band Name',
    'add_new' => 'Add New Band Name',
    'add_new_item' => 'Add New Band Name',
    'edit_item' => 'Edit Band Name',
    'new_item' => 'New Band Name',
    'view_item' => 'View Band Name',
    'search_items' => 'Search Band Names',
    'not_found' =>  'No Band Names found',
    'not_found_in_trash' => 'No Band Names found in trash',
    'parent_item_colon' => '',
    'menu_name' => 'Band Names'
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => false,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title' ),
    'taxonomies' => array( '', ) // this is IMPORTANT
  ); 
  register_post_type( 'band-name', $args );
}
add_action( 'init', 'band_names_post_type' );
// add shortcode that displays a loop of cpt posts on a page or post template
    function get_band_names( $atts) {   
    $args = array(
        'post_type' => 'band-name',
        'posts_per_page' => -1,
    );
    ob_start();
    $band_names = new WP_Query( $args );
    while ( $band_names->have_posts() ) : $band_names->the_post();  
    //get post meta info
    //echo some stuff out
    echo '<div class="band-name"><h3>';
    echo esc_html( the_title() );
    echo '</h3></div>';
    endwhile;
    wp_reset_query();
    return ob_get_clean(); 
    }
// add shortcode that displays a random cpt posts on a page or post template
    add_shortcode('band-name', 'get_band_names');

    // add shortcode that displays a random cpt posts on a page or post template
    function get_single_band_names( $atts) {   
    $args = array(
        'post_type' => 'band-name',
        'posts_per_page' => 1,
        'orderby' => rand,
    );
    ob_start();
    $single_band_names = new WP_Query( $args );
    while ( $single_band_names->have_posts() ) : $single_band_names->the_post();  
    //get post meta info
    //echo some stuff out
    echo '<div class="single-band-name"><h3>';
    echo esc_html( the_title() );
    echo '</h3></div>';
    endwhile;
    wp_reset_query();
    return ob_get_clean(); 
    }
// add shortcode that displays a loop of cpt posts on a page or post template
    add_shortcode('single-band-name', 'get_single_band_names');
?>
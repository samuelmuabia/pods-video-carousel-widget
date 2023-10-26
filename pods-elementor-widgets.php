<?php
/**
 * Plugin Name: Pods Elementor Widget
 * Description: Video Carousel of pods video fields and url
 * Plugin URI:  https://google.com/
 * Version:     1.0.0
 * Author:      Samuel Muabia Planet
 * Text Domain: elementor-video-carousel-widget
 * Elementor tested up to: 3.16.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function enqueue_owl_carousel() {
	wp_enqueue_style( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' );
	wp_enqueue_script( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), "2.3.4", true );
}

add_action('wp_enqueue_scripts', 'enqueue_owl_carousel');

function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
}

add_action('wp_enqueue_scripts', 'enqueue_font_awesome');


function enqueue_plyr_cdn() {
	wp_enqueue_style( 'plyr', 'https://cdnjs.cloudflare.com/ajax/libs/plyr/3.7.8/plyr.css' );

    wp_enqueue_script('plyr', 'https://cdnjs.cloudflare.com/ajax/libs/plyr/3.7.8/plyr.min.js', array(), '3.7.8', true);
}
add_action('wp_enqueue_scripts', 'enqueue_plyr_cdn');

function register_list_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/list-widget.php' );

	require_once( __DIR__ . '/widgets/video-carousel.php' );

	$widgets_manager->register( new \Elementor_List_Widget() );


	$widgets_manager->register( new \Elementor_Video_Carousel_Widget() );

}
add_action( 'elementor/widgets/register', 'register_list_widget' );
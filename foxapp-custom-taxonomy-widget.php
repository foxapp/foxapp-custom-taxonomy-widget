<?php
/**
 * Plugin Name: FoxApp - Custom Taxonomy Widget
 * Description: Custom Elementor widget to display all taxonomies for the current post.
 * Version: 1.0
 * Author: FoxApp
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

function foxapp_custom_taxonomy_widget_init($widgets_manager) {
	require_once( __DIR__ . '/widgets/taxonomy-widget.php' );
	$widgets_manager->register( new \Elementor_Taxonomy_Widget() );
}

add_action('elementor/widgets/widgets_registered', 'foxapp_custom_taxonomy_widget_init');

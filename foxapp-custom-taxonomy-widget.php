<?php
/**
 * @link https://plugins.foxapp.net/
 * Plugin Name: FoxApp - Custom Taxonomy Widget
 * Plugin URI: https://plugins.foxapp.net/foxapp-custom-taxonomy-widget
 * Description: With this plugin, developers can keep information about their projects privately on the GitHub up to date.
 * Version: 1.2.1
 * Author: FoxApp
 * Author URI: https://plugins.foxapp.net/
 * Requires at least: 6.2
 * Requires PHP: >= 7.4
 * Text Domain: foxapp-custom-taxonomy-widget
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Defining plugin constants.
 *
 * @since 1.2.1
 */
define( 'FAEL_PLUGIN_FILE', __FILE__ );
define( 'FAEL_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'FAEL_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'FAEL_PLUGIN_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
define( 'FAEL_PLUGIN_VERSION', '1.2.1' );
define( 'FAEL_ASSET_PATH', wp_upload_dir()['basedir'] . '/foxapp-addons-elementor' );
define( 'FAEL_ASSET_URL', wp_upload_dir()['baseurl'] . '/foxapp-addons-elementor' );

if ( ! class_exists( 'FoxAppPostTaxonomy' ) ) {
	class FoxAppPostTaxonomy {
		public function __construct() {
			// register hooks
			$this->register_hooks();
		}

		protected function register_hooks() {
			// Enqueue
			add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'editor_enqueue_scripts' ] );
			add_action( 'elementor/frontend/before_register_scripts', [ $this, 'frontend_enqueue_scripts' ] );

			// Elementor
			add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'foxapp_custom_taxonomy_widget_init' ] );
		}

		// editor styles
		public function editor_enqueue_scripts() {
			// fa icon font
			wp_enqueue_style(
				'fa-icon',
				$this->safe_url( FAEL_PLUGIN_URL . 'assets/admin/css/faicon.css' ),
				false,
				FAEL_PLUGIN_VERSION
			);

			// editor style
			wp_enqueue_style(
				'fael-editor',
				$this->safe_url( FAEL_PLUGIN_URL . 'assets/admin/css/editor.css' ),
				false,
				FAEL_PLUGIN_VERSION
			);
		}

		// frontend styles
		public function frontend_enqueue_scripts() {
			// ea icon font
			wp_register_style(
				'fa-icon-frontend',
				$this->safe_url( FAEL_PLUGIN_URL . 'assets/admin/css/eaicon.css' ),
				false,
				FAEL_PLUGIN_VERSION
			);
		}

		public function safe_url( $url ) {
			if ( is_ssl() ) {
				$url = wp_parse_url( $url );

				if ( ! empty( $url['host'] ) ) {
					$url['scheme'] = 'https';
				}

				return $this->unparse_url( $url );
			}

			return $url;
		}

		public function unparse_url( $parsed_url ) {
			$scheme   = isset( $parsed_url['scheme'] ) ? $parsed_url['scheme'] . '://' : '';
			$host     = isset( $parsed_url['host'] ) ? $parsed_url['host'] : '';
			$port     = isset( $parsed_url['port'] ) ? ':' . $parsed_url['port'] : '';
			$user     = isset( $parsed_url['user'] ) ? $parsed_url['user'] : '';
			$pass     = isset( $parsed_url['pass'] ) ? ':' . $parsed_url['pass'] : '';
			$pass     = ( $user || $pass ) ? "$pass@" : '';
			$path     = isset( $parsed_url['path'] ) ? $parsed_url['path'] : '';
			$query    = isset( $parsed_url['query'] ) ? '?' . $parsed_url['query'] : '';
			$fragment = isset( $parsed_url['fragment'] ) ? '#' . $parsed_url['fragment'] : '';

			return "$scheme$user$pass$host$port$path$query$fragment";
		}

		public function add_elementor_widget_categories( $elements_manager ) {
			$elements_manager->add_category(
				'foxapp',
				[
					'title' => esc_html__( 'FoxApp', 'foxapp' ),
					'icon'  => 'faicon-logo',
				]
			);
		}

		public function foxapp_custom_taxonomy_widget_init( $widgets_manager ) {
			require_once( __DIR__ . '/widgets/taxonomy-widget.php' );
			$widgets_manager->register( new \Elementor_Taxonomy_Widget() );
		}


	}

	new FoxAppPostTaxonomy();
}

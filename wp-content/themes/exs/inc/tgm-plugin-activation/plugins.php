<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme ExS for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */

require_once EXS_THEME_PATH . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

//required plugins arrays - default and additional for different demos
if ( ! function_exists( 'exs_get_required_plugins_array' ) ) :
	function exs_get_required_plugins_array( $exs_index = 'default', $exs_all = false, $exs_all_flat = false ) {
		$exs_required_plugins_array = apply_filters(
			'exs_required_plugins_array',
			array(
				//Following plugins are required for all demo contents:
				'default' => array(
					array(
						'name'        => esc_html__( esc_html__( 'WordPress SEO by Yoast', 'exs' ), 'exs' ),
						'slug'        => 'wordpress-seo',
						'is_callable' => 'wpseo_init',
					),
					array(
						'name'     => esc_html__( 'ExS Widgets', 'exs' ),
						'slug'     => 'exs-widgets',
					),
					array(
						'name'     => esc_html__( 'Advanced Import: ExS Theme Demo Contents', 'exs' ),
						'slug'     => 'advanced-import',
					),
				),
			)
		);
		if ( ! empty( $exs_all_flat ) ) {
			$exs_required_plugins_array_all = array();
			foreach ( $exs_required_plugins_array as $key => $plugins ) {
				foreach ( $plugins as $plugin ) {
					$exs_required_plugins_array_all[ $plugin['slug'] ] = $plugin;
				}
			}

			return $exs_required_plugins_array_all;
		} elseif ( ! empty( $exs_all ) ) {
			return $exs_required_plugins_array;
		} else {
			return $exs_required_plugins_array[ $exs_index ];
		}
	}
endif; //exs_get_required_plugins_array

add_action( 'tgmpa_register', 'exs_register_required_plugins' );
if ( ! function_exists( 'exs_register_required_plugins' ) ) :
	/**
	 * Register the required plugins for this theme.
	 *
	 * The variables passed to the `tgmpa()` function should be:
	 * - an array of plugin arrays;
	 * - optionally a configuration array.
	 * If you are not changing anything in the configuration array, you can remove the array and remove the
	 * variable from the function call: `tgmpa( $exs_plugins );`.
	 * In that case, the TGMPA default settings will be used.
	 *
	 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
	 */
	function exs_register_required_plugins() {
		/*
		* Array of plugin arrays. Required keys are name and slug.
		* If the source is NOT from the .org repo, then source is also required.
		*/
		//we need this to install different plugins for different demos
		if ( ! empty( $_POST['exs_all_plugins'] ) ) {
			$exs_plugins = exs_get_required_plugins_array( '', false, true );
		} else {
			$exs_plugins = exs_get_required_plugins_array();
		}
		tgmpa(
			$exs_plugins,
			array(
				'domain'       => 'exs',
				'dismissable'  => true,
				'is_automatic' => false,
			)
		);
	}
endif;

//prevent redirects
remove_action( 'bp_admin_init', 'bp_do_activation_redirect', 1 );

///////////////////
//ADVANCED IMPORT//
///////////////////
if ( ! function_exists( 'exs_demo_import_filter_post_ids' ) ) :
	function exs_demo_import_filter_post_ids( $ids ){
		//reusable block
		$ids[] = 'block_id';
		return $ids;
	}
endif;
add_filter( 'advanced_import_replace_post_ids', 'exs_demo_import_filter_post_ids' );
if ( ! function_exists( 'exs_demo_import_filter_term_ids' ) ) :
	function exs_demo_import_filter_term_ids( $ids ){
		//exs widgets
		$ids[] = 'cat';
		$ids[] = 'category';
		return $ids;
	}
endif;
add_filter( 'advanced_import_replace_term_ids', 'exs_demo_import_filter_term_ids' );

//replace image urls in the post content
if ( ! function_exists( 'exs_demo_import_filter_post_data_replace_image_urls' ) ) :
	function exs_demo_import_filter_post_data_replace_image_urls( $post_data ){
		$dir = wp_upload_dir();
		if( ! empty( $post_data) && ! empty($post_data['post_content'])) {
			$post_data['post_content'] = preg_replace( '~http(s?)://.*/sites/([0-9]+)/~i', $dir['baseurl'] . '/', $post_data['post_content']);
			$post_data['post_content'] = preg_replace( '~http(s?)://([a-zA-Z0-9]|/|-|\.)*/themes/exs/~i', EXS_THEME_URI . '/', $post_data['post_content']);
		}

		return $post_data;
	}
endif;
add_filter( 'advanced_import_post_data', 'exs_demo_import_filter_post_data_replace_image_urls' );

if ( ! function_exists( 'exs_demo_import_action_update_elementor_library' ) ) :
	function exs_demo_import_action_update_elementor_library() {
		$elementor_library_query = new WP_Query(
			array(
				//this post type can contain Elementor templates, not only Elementor default kit
				'post_type' => 'elementor_library',
			)
		);
		if ( ! empty ( $elementor_library_query->posts ) && ! empty( $elementor_library_query->posts[0] ) ) :
			//updating auto created elementor kit
			update_option( 'elementor_active_kit', $elementor_library_query->posts[0]->ID );

			if ( ! empty( $_POST ) && ! empty( $_POST['template_url'] ) && ! empty( $_POST['template_url']['content'] ) ) {
				// $demo_url = $_POST['template_url']['content'];
				$import  = advanced_import_admin();
				$imported_content = $import->get_main_content_json();

				//_fve($imported_content['elementor_library']);

				//now we need to import our custom templates and update page settings
				foreach ( $imported_content['elementor_library'] as $post ) :
					//this is kit
					if ( 'Default Kit' === $post['post_title'] ) {
						update_post_meta( $elementor_library_query->posts[0]->ID, '_elementor_page_settings', $post['meta']['_elementor_page_settings'] );
					} else {
						//else this is template
						$post['post_type'] = 'elementor_library';
						$new_id = wp_insert_post( $post );
						//update new template meta
						foreach ( $post['meta'] as $meta_key => $meta_value ) {
							update_post_meta( $new_id, $meta_key, $meta_value );
						}
					}
				endforeach;
			}
		endif; //kit founded
	}
endif;
add_action( 'advanced_import_after_content_screen', 'exs_demo_import_action_update_elementor_library' );

if ( ! function_exists( 'exs_demo_import_action_update_elementor_pages_images' ) ) :
	function exs_demo_import_action_update_elementor_pages_images() {
		$pages_query = new WP_Query(
			array(
				'post_type' => 'page',
				'posts_per_page' => -1,
			)
		);
		$dir = wp_upload_dir();
		if( ! empty( $pages_query->posts ) ) :
			foreach ( $pages_query->posts as $page ) :
				$meta = get_post_meta( $page->ID, '_elementor_data', true);
				if ( $meta ) {
					$meta =json_encode($meta, JSON_UNESCAPED_SLASHES);
					$meta = preg_replace( '~http(s?)://([a-zA-Z0-9]|/|-|\.)*/uploads/(sites/(\d\d?\d?\d?)/)?~i', $dir['baseurl'] . '/', $meta);
					$meta = json_decode( $meta, true);
					update_post_meta( $page->ID, '_elementor_data', $meta );
				}
			endforeach;
		endif; //pages

		//update theme mods images - maybe make these changes later.
		$mods = get_theme_mods();
		foreach ($mods as $mod_name => $mod_value) {
			if( is_string( $mod_value ) && preg_match( '~http(s?)://([a-zA-Z0-9]|/|-|\.)*/uploads/(sites/(\d\d?\d?\d?)/)?~i', $mod_value) ) {
				set_theme_mod($mod_name, preg_replace( '~http(s?)://([a-zA-Z0-9]|/|-|\.)*/uploads/(sites/(\d\d?\d?\d?)/)?~i', $dir['baseurl'] . '/', $mod_value ) );
			}
			//some assets are loading from the child themes and will be missed in the parent theme
			if( false ) {
				if( is_string( $mod_value ) && preg_match( '~http(s?)://([a-zA-Z0-9]|/|-|\.)*/themes/~i', $mod_value) ) {
					set_theme_mod( $mod_name, preg_replace( '~http(s?)://([a-zA-Z0-9]|/|-|\.)*/themes/~i', $dir['baseurl'] . '/', $mod_value) );
				}
			}
		}
	}
endif;
add_action( 'advanced_import_after_complete_screen', 'exs_demo_import_action_update_elementor_pages_images' );

if ( EXS_WP ) {
	require_once EXS_THEME_PATH . '/inc/wp/plugins.php';
}
if ( EXS_TM ) {
	require_once EXS_THEME_PATH . '/inc/tm/plugins.php';
}

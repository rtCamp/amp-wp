<?php
/**
 * Class SupportMenu
 *
 * @package Ampproject\Ampwp
 */

namespace AmpProject\AmpWP\Admin;

use AmpProject\AmpWP\Infrastructure\Conditional;
use AmpProject\AmpWP\Infrastructure\Registerable;
use AmpProject\AmpWP\Infrastructure\Service;
use AmpProject\AmpWP\QueryVar;

/**
 * SupportMenu class.
 */
class Support implements Service, Conditional, Registerable {

	/**
	 * Check whether the conditional object is currently needed.
	 *
	 * @return bool Whether the conditional object is needed.
	 */
	public static function is_needed() {

		return current_user_can( 'manage_options' );
	}

	/**
	 * Adds hooks.
	 */
	public function register() {

		/**
		 * Add support link to Admin Bar.
		 */
		add_action( 'admin_bar_menu', [ $this, 'admin_bar_menu' ], 105 );

		/**
		 * Add support link to meta box.
		 */
		add_filter( 'amp_validated_url_status_actions', [ $this, 'amp_validated_url_status_actions' ], 10, 2 );

		/**
		 * Add support link to Post row actions.
		 */
		add_filter( 'post_row_actions', [ $this, 'post_row_actions' ], PHP_INT_MAX, 2 );

		/**
		 * Plugin row Support link.
		 */
		add_filter( 'plugin_row_meta', [ $this, 'plugin_row_meta' ], 10, 2 );

	}

	/**
	 * Add Diagnostic link to Admin Bar.
	 *
	 * @param \WP_Admin_Bar $wp_admin_bar WP_Admin_Bar object.
	 *
	 * @return void
	 */
	public function admin_bar_menu( $wp_admin_bar ) {

		if ( empty( $wp_admin_bar ) ||
			! is_a( $wp_admin_bar, 'WP_Admin_Bar' ) ||
			! array_key_exists( 'amp', $wp_admin_bar->get_nodes() )
		) {
			return;
		}

		// Get the AMP Validated URL post ID.
		$current_url = remove_query_arg(
			array_merge( wp_removable_query_args(), [ QueryVar::NOAMP ] ),
			amp_get_current_url()
		);

		$post = \AMP_Validated_URL_Post_Type::get_invalid_url_post( $current_url );

		$wp_admin_bar->add_node(
			[
				'parent' => 'amp',
				'title'  => __( 'Support', 'amp' ),
				'id'     => 'amp-support',
				'href'   => esc_url(
					add_query_arg(
						[
							'page'    => 'amp-support',
							'post_id' => ( ! empty( $post ) && is_a( $post, 'WP_Post' ) ) ? $post->ID : 0,
						],
						admin_url( 'admin.php' )
					)
				),
			]
		);
	}

	/**
	 * Add support link to meta box.
	 *
	 * @param string[] $actions Array of actions.
	 * @param \WP_Post $post    Referenced WP_Post object.
	 *
	 * @return string[] $actions Array of actions.
	 */
	public function amp_validated_url_status_actions( $actions, $post ) {

		if ( empty( $post ) ||
			! is_a( $post, 'WP_Post' ) ||
			! \AMP_Validated_URL_Post_Type::POST_TYPE_SLUG === $post->post_type
		) {
			return $actions;
		}

		$query_args = [
			'page'    => 'amp-support',
			'post_id' => $post->ID,
		];

		$actions['amp-support'] = sprintf(
			'<a href="%s">%s</a>',
			esc_url( add_query_arg( $query_args, admin_url( 'admin.php' ) ) ),
			esc_html__( 'Get Support', 'amp' )
		);

		return $actions;
	}

	/**
	 * Add support link to Post row actions.
	 *
	 * @param string[] $actions Array of actions.
	 * @param \WP_Post $post    Referenced WP_Post object.
	 *
	 * @return string[] Array of actions
	 */
	public function post_row_actions( $actions, $post ) {

		if ( empty( $post ) ||
			! is_a( $post, 'WP_Post' )
			|| \AMP_Validated_URL_Post_Type::POST_TYPE_SLUG !== $post->post_type
		) {
			return $actions;
		}

		$query_args = [
			'page'    => 'amp-support',
			'post_id' => $post->ID,
		];

		$actions['amp-support'] = sprintf(
			'<a href="%s">%s</a>',
			esc_url( add_query_arg( $query_args, admin_url( 'admin.php' ) ) ),
			esc_html__( 'Get Support', 'amp' )
		);

		return $actions;
	}

	/**
	 * Plugin row Support link.
	 *
	 * @param string[] $plugin_meta An array of the plugin's metadata, including the version, author, author URI, and
	 *                              plugin URI.
	 * @param string   $plugin_file Path to the plugin file relative to the plugins directory.
	 *
	 * @return string[] Filtered array of plugin's metadata.
	 */
	public function plugin_row_meta( $plugin_meta, $plugin_file ) {

		if ( 'amp/amp.php' === $plugin_file || 'amp-wp/amp.php' === $plugin_file ) {
			$plugin_meta[] = sprintf(
				'<a href="%s">%s</a>',
				esc_url(
					add_query_arg(
						[ 'page' => 'amp-support' ],
						admin_url( 'admin.php' )
					)
				),
				esc_html__( 'Contact support', 'amp' )
			);
		}

		return $plugin_meta;
	}
}
